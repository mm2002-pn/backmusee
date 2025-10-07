var app = angular.module("Modelapp", ["ngRoute", "ngCookies", "ui.bootstrap"]);

var BASE_URL = "//" + location.host + "/backmusee/public/";
const ENTRYLIMIT = 10;
const MAXSIZE = 10;
const CURRENT_PAGE = 1;

location.host.includes("localhost") || location.host.includes("127.0.0.1")
  ? (BASE_URL = "//" + location.host + "/backmusee/public/")
  : (BASE_URL = "//" + location.host + "/");

// Fonction logger
function logger(msg, type) {
  // Si l'environnement est local (détection basée sur le host)
  if (
    location.host.includes("localhost") ||
    location.host.includes("127.0.0.1")
  ) {
    // Log pour l'environnement local
    switch (type) {
      case "info":
        console.log(`INFO: ${msg}`);
        break;
      case "warning":
        console.warn(`WARNING: ${msg}`);
        break;
      case "error":
        console.error(`ERROR: ${msg}`);
        break;
      default:
        console.log(`LOG: ${msg}`);
    }
  } else {
    // Log pour l'environnement de production (limité aux logs essentiels)
    if (type === "error" || type === "warning") {
      // On peut enregistrer les erreurs ou les avertissements dans la production
      console[type](`PRODUCTION - ${type.toUpperCase()}: ${msg}`);
    }
  }
}
const msg_erreur = "Erreur serveur";
let imgupload = BASE_URL + "/assets/images/upload.jpg";

function unauthenticated(error) {
  if (error.status === 401) {
    $scope.showToast("", "Votre session utilisateur a expiré...", "error");
    setTimeout(function () {
      window.location.reload();
    }, 2000);
  }
}

app.factory("theme", function ($cookies) {
  var factory = {
    pathCookie: { path: "/" },
    nameCookie: "theme",
    data: false,
    setCurrent: function (theme) {
      $cookies.putObject(factory.nameCookie, theme, factory.pathCookie);
    },
    getCurrent: function () {
      return !$cookies.getObject(factory.nameCookie)
        ? "theme-Groupe"
        : $cookies.getObject(factory.nameCookie);
    },
    removeCurrent: function ($scope) {
      $cookies.remove(factory.nameCookie, factory.pathCookie);
    },
  };
  return factory;
});
angular.element(document).ready(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();
});

function handleError(error) {
  const { responseJSON, status } = error;

  // Gérez les erreurs non authentifiées
  if (status === 401) {
    unauthenticated(error);
  }

  if (status >= 400 && status < 500) {
    console.error("Erreur client :", responseJSON || error);
  } else if (status >= 500) {
    console.error("Erreur serveur :", responseJSON || error);
  }

  $.unblockUI();

  return {
    status: status,
    data: responseJSON,
  };
}
const CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
// app.config(['$httpProvider', function($httpProvider, CSRF_TOKEN) {
//   $httpProvider.defaults.headers.common['X-CSRF-TOKEN'] = CSRF_TOKEN;
// }]);

app.factory("Init", function ($http, $q) {
  var factory = {
    data: false,
    getElement: function (
      element,
      listeattributs,
      listeattributs_filter = null,
      is_graphQL = true,
      dataget,
      requetteparams = {
        date: null,
      }
    ) {
      var deferred = $q.defer();

      add_text_filter = "";
      let selectedDate = "";

      if (element.indexOf("planninghebdomadaires") !== -1) {
        selectedDate = requetteparams.date;
      }

      if (listeattributs_filter != null && element.indexOf("(") !== -1) {
        args_filter = element.substr(element.indexOf("("), element.length + 1);

        $.each(listeattributs_filter, function (key, attr) {
          add_text_filter =
            (key === 0 ? "," : "") +
            attr +
            args_filter +
            (listeattributs_filter.length - key > 1 ? "," : "") +
            add_text_filter;
        });
        add_text_filter =
          "," + add_text_filter.substr(0, add_text_filter.length);
      }

      let params = encodeURIComponent(element);
      let url =
        BASE_URL +
        (is_graphQL
          ? "graphql?query= {" +
          params +
          " {" +
          listeattributs +
          (add_text_filter ? "," : "") +
          add_text_filter +
          "} }"
          : element);

      if (selectedDate) {
        url += "&selectedDate=" + selectedDate;
      }

      $http({
        method: "GET",
        url: url,
        headers: {
          "Content-Type": "application/json",
        },
        data: dataget,
        headers: {
          "X-CSRF-TOKEN": CSRF_TOKEN, // Ajouter le token CSRF ici
        },
        withCredentials: true,
      }).then(
        function successCallback(response) {
          logger(response, "info");

          const { data, status } = response;
          if (is_graphQL) {
            factory.data =
              data["data"][
              !element.indexOf("(") != -1 ? element.split("(")[0] : element
              ];
          } else {
            factory.data = data;
          }
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        function errorCallback(error) {
          const handledError = handleError(error);
          deferred.reject(handledError);
        }
      );
      return deferred.promise;
    },
    getElementPaginated: function (
      element,
      listeattributs,
      listeattributs_filter
    ) {
      add_text_filter = "";

      if (listeattributs_filter != null) {
        args_filter = element.substr(element.indexOf("("), element.length + 1);

        $.each(listeattributs_filter, function (key, attr) {
          $getAttr = attr;
          $reste = "";
          if (attr.indexOf("{") !== -1) {
            $getAttr = attr.substr(0, attr.indexOf("{"));
            $reste = attr.substr(attr.indexOf("{"), attr.length + 1);
          }
          add_text_filter =
            (key === 0 ? "," : "") +
            $getAttr +
            args_filter +
            $reste +
            (listeattributs_filter.length - key > 1 ? "," : "") +
            add_text_filter;
        });
        add_text_filter =
          "," + add_text_filter.substr(0, add_text_filter.length);
      }
      var params = encodeURIComponent(element);
      var deferred = $q.defer();
      $http({
        method: "GET",
        url:
          BASE_URL +
          "graphql?query={" +
          params +
          "{metadata{total,per_page,current_page,last_page},data{" +
          listeattributs +
          (add_text_filter ? "," : "") +
          add_text_filter +
          "}}}",
        headers: {
          "X-CSRF-TOKEN": CSRF_TOKEN, // Ajouter le token CSRF ici
        },
        withCredentials: true,
      }).then(
        function successCallback(response) {
          const { data, status } = response;
          factory.data =
            data["data"][
            !element.indexOf("(") != -1 ? element.split("(")[0] : element
            ];
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        function errorCallback(error) {
          logger(error, "error");
          const handledError = handleError(error);
          deferred.reject(handledError);
        }
      );
      return deferred.promise;
    },

    saveElement: function (element, data) {
      var deferred = $q.defer();
      $http({
        method: "POST",
        url: BASE_URL + "" + element,
        headers: {
          "Content-Type": "application/json",
        },
        data: data,
      }).then(
        function successCallback(response) {
          const { data, status } = response;
          factory.data = data;
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        function errorCallback(error) {
          const handledError = handleError(error);
          deferred.reject(handledError);
        }
      );
      return deferred.promise;
    },

    generatePdf: function (element, data) {
      var deferred = $q.defer();
      $http({
        method: "POST",
        url: BASE_URL + "" + element,
        headers: {
          "Content-Type": "application/json",
        },
        data: data,
      }).then(
        function successCallback(response) {
          const { data, status } = response;
          factory.data = data;
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        function errorCallback(error) {
          const handledError = handleError(error);
          deferred.reject(handledError);
        }
      );
      return deferred.promise;
    },

    changeStatut: function (element, data, endpoint = "status") {
      var deferred = $q.defer();
      $http({
        method: "POST",
        url: BASE_URL + element + "/" + endpoint,
        headers: {
          "Content-Type": "application/json",
        },
        data: data,
      }).then(
        function successCallback(response) {
          const { data, status } = response;
          factory.data = data;
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        function errorCallback(error) {
          const handledError = handleError(error);
          deferred.reject(handledError);
        }
      );
      return deferred.promise;
    },

    chargeData: function (element, data) {
      var deferred = $q.defer();
      $http({
        method: "POST",
        url: BASE_URL + element,
        headers: {
          "Content-Type": "application/json",
        },
        data: data,
      }).then(
        function successCallback(response) {
          const { data, status } = response;
          factory.data = data;
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        function errorCallback(error) {
          const handledError = handleError(error);
          deferred.reject(handledError);
        }
      );
      return deferred.promise;
    },

    saveElementAjax: function (element, data, is_file_excel = false) {
      var deferred = $q.defer();
      $.ajax({
        url: BASE_URL + element + (is_file_excel ? "/import" : ""),
        type: "POST",
        contentType: false,
        processData: false,
        DataType: "json",
        data: data,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        beforeSend: function () {
          $.blockUI();
        },
        success: function (response) {
          const { data, status } = response;
          $.unblockUI();
          factory.data = data;
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        error: function (error) {
          const handledError = handleError(error);
          deferred.reject(handledError);
        },
      });
      return deferred.promise;
    },

    removeElement: function (element, id) {
      var deferred = $q.defer();
      $http({
        method: "DELETE",
        url: BASE_URL + element + "/" + id,
        headers: {
          "Content-Type": "application/json",
        },
      }).then(
        function successCallback(response) {
          const { data, status } = response;
          factory.data = data;
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        function errorCallback(error) {
          const handledError = handleError(error);
          deferred.reject(handledError);
        }
      );
      return deferred.promise;
    },

    userPermission: function (object) {
      var deferred = $q.defer();
      $http({
        method: "POST",
        url: BASE_URL + "notifuser",
        headers: {
          "Content-Type": "application/json",
        },
        data: object,
      }).then(
        function successCallback(response) {
          const { data, status } = response;
          factory.data = data;
          deferred.resolve({
            status: status,
            data: factory.data,
          });
        },
        function errorCallback(error) {
          const handledError = handleError(error);
          deferred.reject(handledError);
        }
      );
      return deferred.promise;
    },

    generateExcel: function (element, data) {
      var deferred = $q.defer();
      $http({
        method: "GET",
        url: BASE_URL + element + "/" + data,
        headers: {
          "Content-Type": "application/json",
        },
      }).then(
        function successCallback(response) {
          factory.data = response["data"];
          deferred.resolve(factory.data);
        },
        function errorCallback(error) {
          unauthenticated(error);
          deferred.reject(msg_erreur);
        }
      );
      return deferred.promise;
    },
  };

  return factory;
});

app.directive("select2", function () {
  return {
    restrict: "A",
    link: function (scope, element, attrs) {
      $(element).select2();
    },
  };
});

//ICI LA GESTION DES ROUTES
app.config(function ($routeProvider) {
  $routeProvider.when("/:namepage?/:itemId?", {
    templateUrl: function (params) {
      return params.namepage ? params.namepage : "dashboard";
    },
  });
});

app.controller("SideBarController", function ($scope) { });

app.factory("UserLogged", function ($http, $q, $cookies) {
  var factory = {
    pathCookie: { path: "/" },
    data: false,
    loginUser: function (userData) {
      $cookies.putObject("userData", userData, factory.pathCookie);
    },
    isLogged: function () {
      return $cookies.getObject("userData");
    },
    LogOut: function ($scope) {
      $cookies.remove("userData", factory.pathCookie);
    },
  };
  return factory;
});

app.controller(
  "ContentController",
  function (
    Init,
    $scope,
    $rootScope,
    $location,
    $routeParams,
    $filter,
    $timeout,
    UserLogged,
    $http
  ) {
    $scope.toggle_menu = function () {
      $(".content-wrapper").toggleClass("toggled");
      $("#sidebar-wrapper").toggleClass("toggled");
    };
    // console.log(CSRF_TOKEN, "CSRF_TOKEN", $("#crf_token").val());

    //MES VARIABLES
    UserLogged.loginUser($("#userLogged").val());
    console.log(UserLogged.isLogged(), "est connecte");
    $scope.userConnected = UserLogged.isLogged();
    $scope.BASE_URL = BASE_URL;
    $scope.tab = [];
    $scope.days = ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"];
    $scope.selectedCom = 0;
    $scope.selectedComName = "";
    $scope.currentTab = "article";
    $scope.titlePage = "";

    $scope.changeTab = function (tabName) {
      $scope.currentTab = tabName;
    };

    //MODULE FILTER
    $scope.search = false;
    $scope.SearchIcon = "chevron-down";

    $scope.filter = function () {
      $scope.search = !$scope.search;
      if ($scope.search) {
        $scope.SearchIcon = "chevron-up";
      } else {
        $scope.SearchIcon = "chevron-down";
      }
    };

    $scope.activefilter = function () {
      $scope.search = true;
    };

    //MODULE RECHERCHE

    $scope.init = function () {
      $(document).ready(function () {
        $("#hidden1").hide();
        $("#hidden2").hide();
        $("#myModal .select2").each(function () {
          var $p = $(this).parent();
          $(this).select2({
            dropdownParent: $p,
          });
        });
        $("[id^='modal_all']").each(function () {
          $(this)
            .find(".select2")
            .each(function () {
              var $p = $(this).parent();
              $(this).select2({
                dropdownParent: $p,
              });
            });
        });
        $(".select2").select2();
      });
    };

    $scope.CocherToHide = function (idcheck, idhide) {
      let checkbox = $("#" + idcheck);
      let hidden = $("#" + idhide);
      let populate = $("#populate");

      hidden.hide();

      checkbox.change(function () {
        if (checkbox.is(":checked")) {
          hidden.show();
          // Populate the input.
          populate.val(" input populated!");
        } else {
          hidden.hide();
        }
      });
    };



    $scope.checkAllOruncheckAll = function (type) {
      $scope.reInitTabPane("permission_role");

      if (type == "role") {
        const getElement = $("#lespermissions").find(
          'input[id^="permission_role_"]'
        );
        let isChecked = $("#permission_all_role").prop("checked");
        if (isChecked) {
          // cocher tous les roles
          getElement.prop("checked", true);
          getElement.each(function (key, value) {
            let isItemCheched = $(this).prop("checked");
            if (isItemCheched) {
              let permission_id = parseInt($(this).attr("data-permission-id"));
              $scope.dataInTabPane.permission_role.data.push(permission_id);
            }
          });
        } else {
          // decocher tous les roles
          getElement.prop("checked", false);
          $scope.reInitTabPane("permission_role");
        }
      }
    };

    // check data-permission-id passer en parametres

    $scope.checkedPermission = function (id) {
      const element = $("#lespermissions").find(
        'input[id^="permission_role_"]'
      );

      const tabpermissionSize =
        $scope.dataInTabPane.permission_role.data.length;
      if (tabpermissionSize == $scope.dataPage["permissions"].length) {
        $("#permission_all_role").prop("checked", true);
      }

      element.each((index, value) => {
        let inputVal = value.getAttribute("data-permission-id");
        if (inputVal == id) {
          $(value).prop("checked", true);
        }
      });
    };

    $scope.checkedInTab = function (e, id) {
      let isChecked = $(e.target).prop("checked");
      let index = $scope.dataInTabPane.permission_role.data.indexOf(id);
      if (index == -1 && isChecked) {
        $scope.dataInTabPane.permission_role.data.push(id);
      } else if (index != -1 && !isChecked) {
        $scope.deletObjetInDataTabePane(index, "permission_role", index);
      }
    };

    $scope.unChechAllPermissions = function () {
      const getElement = $("#lespermissions").find(
        'input[id^="permission_role_"]'
      );
      getElement.prop("checked", false);
      $scope.reInitTabPane("permission_role");
    };
    $scope.calculateTotalEncaissement = function () {
      if (!$scope.dataPage || !$scope.dataPage['visites']) {
        return 0; // Si les données sont absentes, retourner 0
      }

      let total = 0;
      $scope.dataPage['visites'].forEach(item => {
        if (item.detaillivraisons.length > 0) {
          total += item.montantencaissement || 0; // Ajouter le montant ou 0 s'il n'existe pas
        }
      });

      return total;


    };

    $scope.isAccordionOpen = true;

    $scope.toggleAccordion = function () {
      $scope.isAccordionOpen = !$scope.isAccordionOpen;
    };


    // Initialiser les propriétés manquantes dans les articles
    // $scope.initializeArticles = function () {
    //   if ($scope.dataPage['soumissions'] && $scope.dataPage['soumissions'][0].soumissionarticles) {
    //     $scope.dataPage['soumissions'][0].soumissionarticles.forEach(article => {
    //       article.quantiteCommandee = article.quantiteCommandee || 100;
    //       article.quantiteLivree = article.quantiteLivree || 0;
    //       article.ecartLivraison = article.ecartLivraison || 0;
    //       article.statutLivraison = article.statutLivraison || 'en_attente';
    //       article.livre = article.livre || false;
    //       article.fabriquantLivraison = article.fabriquantLivraison || '';
    //       article.fabriquantDifferent = article.fabriquantDifferent || false;
    //     });
    //   }
    // };

    // // Appeler l'initialisation après le chargement des données
    // $scope.initializeArticles();

    $scope.getDateArrivage = function () {
      if ($scope.dataPage['soumissions'] && $scope.dataPage['soumissions'][0]) {
        return new Date(Date.now() + (14 + Math.floor(Math.random() * 14)) * 24 * 60 * 60 * 1000);
      }
      return new Date();
    };

    $scope.getDelaiLivraison = function () {
      return `${Math.floor(Math.random() * 30) + 5} jours`;
    };

    $scope.getMontantTotal = function () {
      if (!$scope.dataPage['soumissions'] || !$scope.dataPage['soumissions'][0].soumissionarticles) return 0;

      return $scope.dataPage['soumissions'][0].soumissionarticles.reduce((total, article) => {
        return total + (article.prixunitairepropose || 0) * (article.quantiteCommandee || 0);
      }, 0);
    };

    $scope.getMontantAcompte = function () {
      console.log(parseInt($scope.getMontantTotale()), "parseInt($scope.getMontantTotale()) ")
      return parseInt($scope.getMontantTotale()) * 0.3;
    };


    //listes des attributs grapql
    let listofrequests_assoc = {
      permissions: ["id,name,display_name,guard_name,designation"],
      roles: [
        "id,name,ischantenne,iscommercial,isplanning,ischauffeur,auth_mobile,estautoriser,isadmin,guard_name,permissions{id,name,display_name,guard_name}",
      ],
      users: [
        "id,name,email,compteclient,code,login,image,role{id,name,isplanning,isadmin,iscommercial,ischauffeur},role_id ,created_at_fr",
      ],
      clients: [
        "id,COMPTE_0,TYPE_CLIENT_0,axe_id,axe{id,designation},designation,telfixe,telmobile,region,district,categorieclient_id,categorieclient{id,designation},clienttypeclients{id,compte,typeclient_id,typeclient{id,designation}},user_id,user{id,name,role_id,login,email}",
      ],
      pointdeventes: [
        "id,designation,etat,etat_text,etat_badge,estdivers,ventedirect,typepointdevente{id,designation},clef,latitude,longitude,categoriepointdevente{id,designation},zone_id,zone{id,designation},intitule,email,images,img_local,adresse,numbcpttier,telephone,gps,client_id,client{id,name}",
      ],
      prospects: [
        "id,designation,etat,etat_text,etat_badge,estdivers,ventedirect,typepointdevente{id,designation},clef,latitude,longitude,categoriepointdevente{id,designation},zone_id,zone{id,designation},intitule,email,images,img_local,adresse,numbcpttier,telephone,gps",
      ],
      zones: ["id,designation,descriptions,antenne_id,antenne{id,designation}"],
      planninghebdomadaires: [
        "id,user{id,name,role{id,name,isplanning,iscommercial,ischauffeur}},jours{name,id,planning{id,users{id,name,role{id,name,isplanning,iscommercial,ischauffeur}},planningequipements{id,equipement{id,designation,description},quantite},planningproduits{id,produit{id,designation,description},quantite},chauffeur_id,chauffeur{id,name},budget,commentaire,address,voiture{matricule,id,marque},date,datesemaine,planningzones{id,zone{id,designation}}}}",
      ],
      plannings: ["id,date,datesemaine,budget,address,commentaire"],
      voitures: ["id,marque,matricule,code"],
      produits: [
        "id,colisage,designation,prixconseille,prixconseillerdetaillant,totalqte,totalamont,description,code,image,imgurl,unite{designation,id},prix,categorie{id,designation},categorietarifaireproduits{id,unite_id,unite{id,designation},prix,remise,produit{id,designation},categorietarifaire{id,designation}}",
      ],
      visites: [
        "id,etatquantite,isarticlevalidate,ismaterielvalidate,modepaiement{id,designation},montantencaissement,montantencaissement_text,antenne,etatmateriel,code,etatreglement,etatrecouvrement,encaissements{id,isreglement,numfacture,montantaregle,montantrecouvrement,montantreglement,montantrecuperer,typeencaissement_id,typeencaissement{id,designation}}, pointdevente_id,detailmateriels{id,est_activer,visite_id,demande{id},type,etat_badge,etat_text,quantite,equipement_id,equipement{id,designation,}},detaillivraisons{id,unite{id,designation},quantite,total,produit_id,produit{id,designation}}, pointdevente{id,intitule,designation},commercial_id,commercial{id,name},date,commentaire",
      ],
      demandes: [
        "id,etat_text,etat_badge,date,detailmateriels{id,est_activer,equipement{id,designation},visite{etatmateriel},quantite},commercial_id,commercial{id,name},pointdevente_id,pointdevente{id,intitule}",
      ],
      equipements: ["id,designation,description"],
      categories: ["id,designation,description"],
      typepointdeventes: ["id,designation"],
      categoriepointdeventes: ["id,designation"],
      planningproduits: [
        "id,quantite,totalmontant,totalmontantlivre_text,totalmontant_text,quantite_chargee,quantite_total_livree,quantite_livree_commercial,delta,delta_commercial,pourcentage_livraison,pourcentage_livraison_commercial,prixunitaire,prixunitaire_text,produit{id,designation,description,prix,}",
      ],
      planningequipements: [
        "id,quantite_total_livree,quantite_livree_commercial,delta,delta_commercial,equipement{id,designation,description},qtelivre,delta,totalmontant,totalmontant_text,totalmontantlivre_text,totalmontantlivre,quantite",
      ],
      preferences: ["id,nbreutilisateur,ninea"],
      histogrammehebdommadaires: [
        "id,name,total_comm_visites,pourcentage ,total_visites,montant_totals,montantcomm_totals",
      ],
      histogrammes: [
        "produit_id,quantite_totale,chiffre_affaires,produit{id,designation}",
      ],
      histogrammebestclients: ["id,total_quantite,ca,intitule"],
      histogrammebestproduits: [
        "id,designation,quantiteproduits,pourcentage,montant_totals,image",
      ],
      detaillivraisons: [
        "id,total,visite{date,pointdevente{id,intitule,numbcpttier},code,planning{voiture{matricule}}},quantite,produit_id,produit{id,code,prix,designation}",
      ],
      antennes: ["id,designation,code"],
      bls: [
        "id,code,commercial_id,issend,etat_text,etat_badge,commercial{id,name},date,datedebut,datefin,dateenvoie, detailbls{id,quantite,produit_id,produit{id,designation},pointdevente{id,intitule,designation}}",
      ],
      categorietarifaires: ["id,designation,description,"],
      unites: ["id,designation,description,code"],
      modepaiements: ["id,designation,image,imgurl,desc,code"],
      cashflows: ["date_debut,week,total_encaissements,total_reglements,count,date_fin"],
      typeclients: ["id,designation,description"],
      categorieclients: ["id,designation,description"],
      typelivraisons: ["id,designation,description"],
      phasedepots: ["id,datedeb,designation,description,datefin,campagne_id,campagne{id,designation}"],
      equipegestions: ["id,designation,description"],
      articles: ["id,articleremisedureedevies{id,remisepourcentage,remisedureedevie{id,etat_text,moinsnim,moismax}},designation,quantite,description,prix,code,categorie_id,categorie{id,designation},unite{id,designation},COURTEDUREE_0,courteduree_text"],
      bailleurs: ["id,nom,pays,contact,emailcontact,telephone,fax,fixe,user{id,name,role_id,login,email}"],
      commandes: ["id,statut,etat_text,etat_badge,detailcommandes{id,quantite,prix,avg,quantite,article_id,article{id,designation}},datecommande,datereception,client_id,typelivraison_id,client{id,designation},typelivraison{id,designation},campagne_id,campagne{id,designation,datefin,date,etat_text,etat_badge,image}"],
      programmes: ["id,designation,nbrecommades,nbre_programmes_en_cours,nbre_programmes_termine,missions,date,etat_text,etat_badge,equipegestion_id,equipegestion{id,designation},objectif,bailleurprogrammes{id,bailleur{id,nom,pays,contact,emailcontact,telephone,fax,fixe,etat_badge,etat_text,estactive}},lignecommandes{id,quantite,article_id,article{id,designation,estactive,etat_badge,etat_text}},campagnes{id,designation,date,datefin}"],
      campagnes: ["id,date,datefin,nbrecommades,image,designation,statut,phasedepots{id,datedeb,datefin,designation,description},programme{id,designation},lignecommandes{id,quantite,article_id,article{id,designation}},date,commandes{id,etat_text,etat_badge,client{id,designation},datecommande,datereception,statut,typelivraison_id,typelivraison{id,designation},detailcommandes{id,quantite,prix,avg,article_id,article{id,designation}}}"],
      typeaos: ["id,designation"],
      typeprocedures: ["id,designation"],
      typefournisseurs: ["id,designation"],
      typeconditions: ["id,designation"],
      fichierfournisseurs: ["id,designation"],
      provinces: ["id,province,distance,code"],
      typemarches: ["id,type,designation,description,code,typemarchedetails{id,detailtypemarchedetails{id,role{id,name}},position,description,parcourmarche{id,designation}}"],
      das: ["id,daevenements{id,designation,date},etat_badge,YTYPEPASS_0,PSHNUM_0,CREDATTIM_0,typemarche_id,typemarche{id,type,designation,description,code,typemarchedetails{id,detailtypemarchedetails{id,role{id,name}},position,description,parcourmarche{id,designation}}},demandeur_id,preparateur_id,demandeur{id,name},preparateur{id,name},demandeur_id,preparateur_id,etat, etat_text,demandeur{id,name},preparateur{id,name},etatdao,etatdao_text,datepub,datecloture,dateouvertureoffre,etatdaofournisseur,etatdaofournisseur_text,dadocumentspecifications{id,isannexe,da_id,url,designation,date,documentspecification_id,documentspecification{id,etape,etatetexte,designation,nature,typemarche_id,typemarche{id,designation}}}"],
      detailsdas: ["id,PSHNUM_0,ITMREF_0,ITMDES_0,QTYSTU_0,unite{id,designation},article{id,code,designation},NETPRI_0,GROPRI_0,margevaleur,margepourcentage,coeff"],
      parcourmarches: ["id,designation,description"],
      fournisseurs: ["id,parkings{id,vehicule_id,vehicule{id,chauffeur{id,nom},description,volume,typevehicule_id,typevehicule{id,designation},tonnage_id,tonnage{id,designation,tonnage},marque,matricule},fournisseur_id,fournisseur{id,nom,TSSCOD_0_0}},TSSCOD_0_0,annee,evaluationsfournisseurs{id,fournisseur_id,fournisseur{id,nom},mesure_id,annee,delailivraison,desistement,conformitetechnique,reclamation,reponsesreclamation,controlmarketing,totalnotes,totalweighted,finalscore,qualification,signatureappro,signaturequality,signaturesupply,signaturepharmacist,signaturedirector},code,nom,telephone,adresse,categoriefournisseur{id,designation},score,typefournisseur{id,designation}"],
      aos: ["id,isarticletemplate,dateouvertureoffre,datecloture,isnotationfournisseur,isnotationarticle,isnotationadministrative,statut,date,soumissions{id,isarticletemplate,etatcontractel,statut,date,score,commitevalidate,etat_text,etat_badge,urlbc,urlcontrat,isbc,iscontrat,ao_id,fournisseur_id,fournisseur{id,nom,score},soumissionarticles{id,quantitedemande,targetprice,quantitepropose,soumission{id,isarticletemplate,fournisseur_id},isselected,resultatevaluation,prixunitairepropose,presenceechantillon,presencedossierstech,pays_id,observationsaq,prequalification,statutamm,fabricant_id,fabricant{id,designation},article_id,article{id,designation,code,prix,laststatutamm{id},lastprequalification{id},categorie{id,designation}},score,prixunitairepropose,typecondition_id,typecondition{id,designation}}},etat_text,etat_badge,reference,designation,typemarche_id,typemarche{id,designation},typeprocedure_id,typeprocedure{id,designation},datepublication,typeprocedure{id,designation},aoarticles{id,quantite,targetprice,article{id,code,designation}},aofournisseurs{id,fournisseur{id,nom,email,score,telephone,adresse,typefournisseur{id,designation},categoriefournisseur{id,designation}}}"],
      pays: ["id,designation"],
      soumissions: ["id,etatcontractel,statut,date,score,statut,isbc,iscontrat,nomcontrat,datecontrat,urlcontrat,ao_id,fournisseur_id,fournisseur{id,nom,score,categoriefournisseur{id,designation}},soumissionarticles{id,delailivraison,quantitedemande,targetprice,quantitepropose,isselected,resultatevaluation,prixunitairepropose,presenceechantillon,presencedossierstech,pays_id,observationsaq,prequalification,statutamm,fabricant_id,fabricant{id,designation},article_id,article{id,designation,code,prix},score,prixunitairepropose,typecondition_id,typecondition{id,designation}}"],
      daofournisseurs: ["id,fournisseur_id,fournisseur{nom,id}"],
      documentspecifications: ["id,designation,etape,section,sectiontexte,etatetexte,designation,nature,typemarche_id,typemarche{id,designation}"],
      prequalifications: ["id,fabricant_id,fabricant{id,designation,code,email},anneeprequalification,anneeexpiration,referenceaoip,code,type,denomination,article_id,article{id,designation},cdt,fournisseur_id,adresse,pays_id,pays{id,designation},statut,dateprequalification,fournisseur{id,nom},fabriquant,etat_text"],
      statutamms: ["id,laboratoirefabriquant_id,laboratoiretitulaire_id,codeproduit,article_id,article{code,designation},fournisseur_id,fournisseur{nom},nomcommercial,designationsalama,laboratoiretitulaire,laboratoirefabriquant,numeroamm,datedelivrance,dateexpiration,statutenregistrement,etat_text"],
      remisedureedevies: ["id,typeduree,moinsnim,moismax,remisepourcentage,remisevaleur,etat_text"],
      axes: ["id,code,designation,description,province_id,province{id,province},axetonnages{id,tonnage{id,designation,tonnage}}"],
      fabricants: ["id,designation,code,email,adresse"],
      mesures: ["id,designation,description"],
      evaluationsfournisseurs: ["id,fournisseur_id,noteevaluations{id,note,fichecritere_id,fichecritere{id,ponderation}},fournisseur{id,nom,categoriefournisseur{id,designation},typefournisseur{id,designation}},mesure_id,annee,delailivraison,desistement,conformitetechnique,reclamation,reponsesreclamation,controlmarketing,totalnotes,totalweighted,finalscore,qualification,signatureappro,signaturequality,signaturesupply,signaturepharmacist,signaturedirector,etatsignatureappro,etatsignaturequality,etatsignaturesupply,etatsignaturepharmacist,etatsignaturedirector"],
      criteres: ["id,designation,description,points,echelleevaluations{id,min,max,designation,ordre,points}"],
      ficheevaluations: ["id,modelfiche,etat_text,TSSCOD_0_0,workflows{id,position,role_id,role{id,name}},annee,designation,isactive,fichecriteres{id,ponderation,ordre,critere_id,critere{id,points,designation,echelleevaluations{id,points,designation,min,max,ordre}}}"],
      tonnages: ["id,tonnage,unite_id,designation,unite{id,designation,code}"],
      typevehicules: ["id,designation,description"],
      vehicules: ["id,description,chauffeur_id,volume,etat_text,etat_badge,typevehicule_id,typevehicule{id,designation},tonnage_id,tonnage{id,designation,tonnage},marque,matricule,parkings{id,vehicule_id,vehicule{id,description,volume,typevehicule_id,typevehicule{id,designation},tonnage_id,tonnage{id,designation,tonnage},marque,matricule},fournisseur_id,fournisseur{id,nom,TSSCOD_0_0}}"],
      chauffeurs: ["id,nom,code,adresse,email,telephone,vehicules{id,description,volume,matricule}"],
      parkings: ["id,vehicule_id,vehicule{id,chauffeur_id,chauffeur{id,nom,email},description,volume,typevehicule_id,typevehicule{id,designation},tonnage_id,tonnage{id,designation,tonnage},marque,matricule},fournisseur_id,fournisseur{id,nom,TSSCOD_0_0}"],
    };

    $scope.changeCourteDuree = function () {
      console.log($("#COURTEDUREE_0_list_article").val(), $scope.COURTEDUREE_0_list_article);
    }

    $scope.generateAddFiltres = function (currentpage) {
      currentpage = `_list_${currentpage}`;
      let addfiltres = "";
      let title = "";
      let currentvalue = "";
      let can_add = true;

      $(
        "input[id$=" +
        currentpage +
        "], textarea[id$=" +
        currentpage +
        "], select[id$=" +
        currentpage +
        "]"
      ).each(function () {
        title = $(this).attr("id");
        title = title.substring(0, title.length - currentpage.length);
        currentvalue = $(this).val();
        console.log(title, "title");

        if (currentvalue && title.indexOf("searchtexte") === -1) {
          can_add = true;

          if ($(this).is("select")) {
            console.log(title, "title 1");
            if (title !== "statut" && title !== "estinterne")
              title = `${title}_id`;
            console.log(title, "title  1 1");
          } else if ($(this).is("input") || $(this).is("textarea")) {
            if ($(this).attr("type") === "radio") {
              title = $(this).attr("name");
              currentvalue = $(
                "#" + $(this).attr("id") + "[name='" + title + "']:checked"
              ).attr("data-value");
              if (addfiltres.indexOf(title) !== -1 || !currentvalue) {
                can_add = false;
              }
            }
            if ($(this).attr("type") === "checkbox") {
              // rien pour le moment
            }
            if ($(this).attr("type") === "number") {
            }
            if (
              $(this).attr("type") === "date" ||
              $(this).attr("type") === "text" ||
              $(this).is("textarea") ||
              $(this).attr("type") === "time"
            ) {
              currentvalue = `"${currentvalue}"`;
            }
            if ($(this).attr("type") === "color") {
              title = $(this).attr("name");
            }
          }

          if (title.indexOf("searchoption") !== -1) {
            title = currentvalue;
            currentvalue = $("#searchtexte" + currentpage).val();
            currentvalue = `"${currentvalue}"`;

            if (!$("#searchtexte" + currentpage).val()) {
              can_add = false;
            }
          }
          if (can_add) {
            if (title === "couleur") {
              currentvalue = currentvalue.replace("#", "");
            }
            addfiltres = `${addfiltres},${title}:${currentvalue}`;
          }
        }
      });

      $scope.filters = addfiltres.replace(/^,/, "");
      console.log($scope.filters, "filters");
      return addfiltres;
    };

    // Pour générer les formulaires d'ajout dans les sections TabPane du modal
    $scope.dataInTabPane = {
      user_departement_user: { data: [], rules: [] },
      permission_role: { data: [], rules: [] },
      planning_ac_planning: { data: [], rules: [] },
      produit_commande: { data: [], rules: [] },
      produit_detaillivraison: { data: [], rules: [] },
      categorietarifaire_produit: { data: [], rules: [] },
      remisedureedevie_article: { data: [], rules: [] },
      equipement_planning: { data: [], rules: [] },
      equipement_detailmateriel: { data: [], rules: [] },
      planning_planning: { data: [], rules: [] },
      zone_planning: { data: [], rules: [] },
      demandes_demande: { data: [], rules: [] },
      pointdeventes_zone: { data: [], rules: [] },
      jour_plannings: { data: [], rules: [] },
      typemarchedetails_typemarche: { data: [], rules: [] },
      daoDocuments: { data: [], rules: [] },
      daevenements: { data: [], rules: [] },
      echelleevaluations_critere: { data: [], rules: [] },
      ficheevaluations_ficheevaluation: { data: [], rules: [] },
      workflows_ficheevaluation: { data: [], rules: [] },
      detailequipegestionclient_equipegestionclient: { data: [], rules: [] },
      detailstatuts_statutamm: { data: [], rules: [] },
      fournisseurs_da: { data: [], rules: [] },

    };


    $scope.validerEvaluation = function (vehicule) {
      // Simuler que l'article a été évalué
      vehicule.evaluation = {
        presencedossierstech: "1",  // Oui
        observationsaq: "Dossier complet",
        resultatevaluation: "1"    // Conforme
      };

      alert("Évaluation du véhicule " + vehicule.immatriculation + " validée !");
    };
    $scope.validerToutesEvaluations = function () {
      $scope.soumissionnaire.vehicules.forEach(function (vehicule) {
        vehicule.evaluation = {
          presencedossierstech: "1",
          observationsaq: "Auto validé",
          resultatevaluation: "1"
        };
      });
      alert("Toutes les évaluations ont été simulées comme validées !");
    };
    $scope.validerEvaluationsGlobale = function () {
      // On simule une validation pour chaque véhicule
      $scope.soumissionnaire.vehicules.forEach(function (vehicule) {
        vehicule.evaluation = {
          presencedossierstech: vehicule.evaluation?.presencedossierstech || "1",
          observationsaq: vehicule.evaluation?.observationsaq || "Validé automatiquement",
          resultatevaluation: vehicule.evaluation?.resultatevaluation || "1"
        };
      });

      // On met l’état global à "valide"
      $scope.soumissionnaire.evaluationEtat = "valide";
    };


    $scope.addtypemarchedetails = function (index = null) {
      console.log(index)
      if (index == null) {
        var position = $("#position_typemarchedetails").val();
        var parcourmarche = $("#parcourmarche_id_typemarchedetails").val();
        var rolesIds = $("#role_typemarchedetails").val();

        let roles = $scope.dataPage["roles"].filter(role => rolesIds.includes(role.id));
        console.log(roles, "reole ");
        console.log(roles, "test");
        if (parcourmarche) {
          console.log('Parcour', parcourmarche)
          var parcours = $scope.dataPage['parcourmarches'].find(c => c.id === parcourmarche + "");
          console.log('Parcours', parcours, $scope.dataPage['parcourmarches'])
          if (parcours) {
            $scope.dataInTabPane.typemarchedetails_typemarche.data.push(
              {
                "parcourmarche": { id: parcours.id, designation: parcours.designation },
                "position": position,
                "rolesId": rolesIds,
                "roles": roles
              }
            );
          }
        }
      } else {
        $scope.dataInTabPane.typemarchedetails_typemarche.data.splice(index, 1)
      }

      // vider
      $("#position_typemarchedetails").val('').trigger('change');
      $("#parcourmarche_id_typemarchedetails").val('').trigger('change');
      $("#role_typemarchedetails").val('').trigger('change');

      console.log($scope.dataInTabPane.typemarchedetails_typemarche);
    }

    $scope.addstatutdetails = function (index = null, etat = null) {

      if (index == null) {
        var statut = $("#statut_statutamm").val();
        var motifs = $("#motifs_detailstatuts_statutamm").val();
        var date = new Date();
        var etat = 0;

        var statutValide = $scope.dataInTabPane.detailstatuts_statutamm.data.find(c => c.etat === 1);
        if (!statutValide) {
          etat = 1;
        }

        $scope.dataInTabPane.detailstatuts_statutamm.data.push(
          {
            "statut": statut,
            "motifs": motifs,
            "date": date,
            "etat": etat
          }
        );
        $("#statut_statutamm").val('');
        $("#motifs_detailstatuts_statutamm").val('');
      }
      else if (etat === null) {
        console.log(index, etat)
        $scope.dataInTabPane.detailstatuts_statutamm.data.splice(index, 1)
        console.log($scope.dataInTabPane.detailstatuts_statutamm.data);
      }
      else if (etat === 0 || etat === 1) {
        console.log(etat)
        $scope.dataInTabPane.detailstatuts_statutamm.data[index]['etat'] = etat;
      }

      // vider
      $("#position_typemarchedetails").val('').trigger('change');
      $("#parcourmarche_id_typemarchedetails").val('').trigger('change');
      $("#role_typemarchedetails").val('').trigger('change');

    }
    $scope.selectedTypeMarche = null;

    $scope.onChangeTypeMarche = function () {
      console.log("Type marché sélectionné:", $scope.selectedTypeMarche);

      // Vider le tableau des détails lorsqu'un type est sélectionné
      $scope.dataInTabPane.typemarchedetails_typemarche.data = [];

      // Optionnel: Réinitialiser les champs du formulaire
      $("#position_typemarchedetails").val('').trigger('change');
      $("#parcourmarche_id_typemarchedetails").val('').trigger('change');
      $("#role_typemarchedetails").val('').trigger('change');

      console.log("Tableau vidé:", $scope.dataInTabPane.typemarchedetails_typemarche.data);
    };


    // pour la suppression des éléments dans les sections TabPane du modal
    $scope.deletObjetInDataTabePane = function (item, tagForm, index) {
      if (
        $scope.dataInTabPane[tagForm]["data"] &&
        $scope.dataInTabPane[tagForm]["data"].length > 0
      ) {
        $scope.dataInTabPane[tagForm]["data"].splice(index, 1);
      }
    };

    // pour la suppression des éléments dans les dataPages dans detail page
    $scope.deletObjetInDataPage = function (item, tagForm, obj, index) {
      iziToast.question({
        timeout: 0,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 4000,
        title: "Suppression",
        message: "Voulez-vous vraiment supprimer cet élément ?",
        position: "center",
        buttons: [
          [
            '<button class="font-bold btn btn-success" style="color: green!important">Confirmer</button>',
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
              if (
                $scope.dataPage[tagForm][0] &&
                $scope.dataPage[tagForm].length > 0
              ) {
                $scope.$apply(function () {
                  $scope.dataPage[tagForm][0][obj].splice(index, 1);

                  $scope.showToast(
                    "SUCCES",
                    "Suppression effectuée avec succès",
                    "success"
                  );
                });
              }
            },
            true,
          ],
          [
            '<button class="btn btn-danger" style="color: red!important">Annuler</button>',
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
          ],
        ],
        onClosing: function (instance, toast, closedBy) { },
        onClosed: function (instance, toast, closedBy) { },
      });
    };

    $scope.trieParOrdreCroissant = function (tableau) {
      if (tableau && tableau.length > 0) {
        for (i = 0; i < tableau.length - 1; i++) {
          for (j = i; j < tableau.length; j++) {
            let tempon = tableau[i];
            if (tableau[i].supplement < tableau[j].supplement) {
              tableau[i] = tableau[j];
              tableau[j] = tempon;
            }
          }
        }
      }
      return tableau;
    };

    // reinitialize le dataIntabPane
    $scope.reInitTabPane = function (tagForm) {
      $scope.dataInTabPane[tagForm]["data"] = [];
    };

    // mes methodes
    $scope.getelements = function (
      type,
      optionals = {
        queries: null,
        typeIds: null,
        otherFilters: null,
        requetteparams: null,
      },
      filtres = null,
      map = null
    ) {
      var rewriteattr = null;

      if (map) {
        rewriteattr =
          map == "map"
            ? Array(
              "intitule",
              "gps",
              "zone_id",
              "commercial",
              "date",
              "quantitemateriels",
              "quantiteproduits",
              "total"
            )
            : Array("id", "designation");
      } else {
        $.blockUI();
        rewriteattr = listofrequests_assoc[type];
      }

      var listeattributs_filter = [];
      rewriteType = type;
      if (optionals?.queries) {
        rewriteType = rewriteType + "(";
        $.each(optionals.queries, function (KeyItem, queryItem) {
          rewriteType = rewriteType + queryItem;
        });
        rewriteType = rewriteType + ")";
      }

      if (optionals?.requetteparams) {
        date = optionals.requetteparams;
      }

      if (filtres) {
        rewriteType = rewriteType + "(" + filtres + ")";
      }

      Init.getElement(
        rewriteType,
        rewriteattr,
        listeattributs_filter,
        true,
        null,
        (requetteparams = {
          date: optionals?.requetteparams ? optionals.requetteparams : null,
        })
      ).then(
        function (data) {
          if (data.data != null && !data.errors) {
            // Traitement normal des données
            $scope.dataPage[type] = data.data;

            $.unblockUI();
            if (type == "permissions") {
              $scope.temponPermissions = data;
            } else if (type === "das") {
              $scope.getbesoin = data?.data[0];
            }
          } else if (data.errors && data.errors.length > 0) {
            // Gestion des erreurs
            $.unblockUI();

            for (let field in data.errors) {
              $scope.showToast(
                "LIST",
                `<span class="h4">${data.errors[field].message}</span>`,
                "error"
              );
            }
          } else {
            // Cas où data.errors est null ou data n'est pas dans l'intervalle 200-299
            console.error("Réponse inattendue :", data);
            $.unblockUI();
            $scope.showToast(
              "ERREUR",
              "Une erreur inattendue s'est produite.",
              "error"
            );
          }
        },
        function (error) {
          if (error.status) {
            $.unblockUI();
            $scope.showToast(
              "List",
              '<span class="h4">Erreur depuis le serveur, veuillez contacter l\'administrateur</span>',
              "error"
            );
          }
        }
      );
    };

    $scope.pageChanged = function (
      currentpage,
      optionals = {
        justWriteUrl: null,
        option: null,
        saveStateOfFilters: false,
        order: null,
        queryfilters: null
      },
      map = null,
      cpt = null
    ) {
      $scope.search = false;

      if (!map) {
        $.blockUI();
      }

      $scope.filters = "";
      $scope.permissionResources = $scope.currentTemplateUrl;

      if (currentpage == 'expressionbesoin') {
        currentpage = 'da';
      }

      let typeFilter = currentpage;
      let currentpageReal = currentpage;

      let addrewriteattr = null;
      $scope.testcontrat = 0;
      let rewriteelement = "";
      let rewriteattr = null;

      if (map) {
      } else {
        $.blockUI();
      }
      rewriteattr = listofrequests_assoc[currentpage + "s"]
        ? listofrequests_assoc[currentpage + "s"][0]
        : null;

      if (rewriteattr) {
        let filters = $scope.generateAddFiltres(typeFilter);

        if (!$scope.paginations[currentpage]) {
          $scope.paginations[currentpage] = {
            currentPage: 1,
            maxSize: 10,
            entryLimit: ENTRYLIMIT,
            totalItems: 0,
          };
        }

        let page = 1;
        if (map && cpt) {
          page = cpt;
        } else {
          page = $scope.paginations[currentpage].currentPage;
        }
        let count = Number.isNaN(
          Number($scope.paginations[currentpage]?.entryLimit)
        )
          ? 10
          : $scope.paginations[currentpage]?.entryLimit ?? ENTRYLIMIT;
        if ($scope.orderby) {
          filters += $scope.orderby;
        }

        if (optionals?.order) {
          filters += ',order:"' + optionals.order + '"';
          console.log(filters);
        }

        if (optionals?.queryfilters) {
          filters += ',' + optionals.queryfilters;
        }

        rewriteelement =
          currentpage +
          "spaginated(page:" +
          page +
          ",count:" +
          count +
          filters +
          ")";

        if (rewriteelement) {
          Init.getElementPaginated(
            rewriteelement,
            rewriteattr,
            addrewriteattr
          ).then(
            function (data) {
              $.unblockUI();
              if (data.status === 500) {
                $scope.showToast("ERREUR", msg_erreur, "error");
              }

              if (data.data != null && !data.errors) {
                $scope.dataPage[currentpage + "s"] = data.data.data;

                $scope.paginations[currentpage].currentPage =
                  data.data.metadata.current_page;
                $scope.paginations[currentpage].totalItems =
                  data.data.metadata.total;
              }
            },
            function (msg) {
              $.unblockUI();
            }
          );
        }
      } else {
        if (currentpage == "dashboard") {
          $.unblockUI();
          filters = $scope.generateAddFiltres(typeFilter);
        }
      }
      $(".numbers").keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, "");
        this.value = this.value.replace(/\./g, " ");
      });
    };

    $scope.detailFiche = null;

    $scope.filterPlanning = function () {
      $scope.getelements(
        "planninghebdomadaires",
        (optionals = {
          requetteparams: $scope.dateFilter ? $scope.dateFilter : null,
        })
      );
    };
    $scope.recursiveCallback = function () {
      // Initialiser la pagination
      let currentPage = "pointdevente"; // Modifier en conséquence selon vos bsoins

      $scope.paginations[currentPage].entryLimit = 100; // Définir la limite initiale d'entrée à 5
      $scope.paginations[currentPage].currentPage = 1; // Définir la page initiale à 1

      let cpt = 0;
      function loadDataPeriodically() {
        cpt++;
        $scope.pageChanged(currentPage, null, "map", cpt);

        let totalpages = Math.ceil(
          $scope.paginations[currentPage]?.totalItems / 100
        );

        if (
          $scope.paginations[currentPage]?.totalItems != 0 &&
          cpt >= totalpages
        ) {
          clearInterval(intervalId); // Arrêter l'intervalle si toutes les données sont chargées
        }
      }

      // Définir l'intervalle initial
      let intervalId = setInterval(loadDataPeriodically, 100);
    };

    // viewcontenloaded
    $scope.$on("$viewContentLoaded", function () {


      if ($scope.currentTemplateUrl.indexOf("list-detailcommandesimuler") !== -1) {
        // Initialisation des variables
        $scope.activeStep = 1;
        $scope.step1Completed = false;
        $scope.step2Completed = false;
        $scope.step3Completed = false;
        $scope.step4Completed = false;
        $scope.today = new Date();
        $scope.anneeActuelle = $scope.today.getFullYear();
        $scope.totalCommande = 0;
        $scope.facturesProforma = [];

        // Données de lots disponibles avec informations complètes (FIFO)
        $scope.lotsDisponibles = {
          'Paracétamol 500mg': [
            { id: 'LOT-PARA-001', peremption: '2024-12-15', prix: 2500, stockAgence: 1500, stockCentral: 5000 },
            { id: 'LOT-PARA-002', peremption: '2025-03-20', prix: 2600, stockAgence: 800, stockCentral: 3000 },
            { id: 'LOT-PARA-003', peremption: '2025-06-10', prix: 2700, stockAgence: 2000, stockCentral: 4000 }
          ],
          'Sirop contre la toux': [
            { id: 'LOT-SIROP-010', peremption: '2024-11-30', prix: 3500, stockAgence: 500, stockCentral: 2000 },
            { id: 'LOT-SIROP-011', peremption: '2025-02-15', prix: 3700, stockAgence: 700, stockCentral: 2500 }
          ],
          'Gants médicaux stériles': [
            { id: 'LOT-GANTS-100 2025-09-04 75%PU 50000 230000', peremption: '2025-09-04', prix: 50000, stockAgence: 230000, stockCentral: 0 },
            { id: 'LOT-GANTS-1001 2025-09-30 20%PU 65000 450000', peremption: '2025-09-30', prix: 65000, stockAgence: 0, stockCentral: 450000 },
            { id: 'LOT-GANTS-1001 2025-10-01 10%PU 80000 320000', peremption: '2025-10-01', prix: 80000, stockAgence: 0, stockCentral: 320000 },
            { id: 'LOT-GANTS-1001 2027-10-01 0%PU 100000 590000', peremption: '2027-10-01', prix: 100000, stockAgence: 0, stockCentral: 590000 }
          ],
          'Thermomètre digital': [
            { id: 'LOT-THERMO-200', peremption: '2026-05-15', prix: 12000, stockAgence: 50, stockCentral: 200 }
          ],
          'Crème antiseptique': [
            { id: 'LOT-CREME-300', peremption: '2025-08-10', prix: 4500, stockAgence: 300, stockCentral: 1000 },
            { id: 'LOT-CREME-301', peremption: '2025-12-15', prix: 4800, stockAgence: 200, stockCentral: 800 }
          ]
        };

        // Données de stock simulées
        $scope.stocks = {
          'Paracétamol 500mg': 15,
          'Sirop contre la toux': 8,
          'Gants médicaux stériles': 20,
          'Thermomètre digital': 5,
          'Crème antiseptique': 25
        };

        // Fonction pour déterminer automatiquement la source d'approvisionnement
        // Fonction pour déterminer automatiquement la source d'approvisionnement
        $scope.actualiserSourceArticle = function (article) {
          if (!$scope.commande.approvisionnement) return;

          const designation = article.designation;
          const quantiteDemandee = article.quantite || 0;

          if ($scope.commande.approvisionnement === 'agence') {
            // Mode agence uniquement
            article.source = 'agence';
            // Appliquer FIFO - prendre le premier lot disponible en agence
            const lotsAgence = $scope.lotsDisponibles[designation].filter(lot => lot.stockAgence > 0);
            if (lotsAgence.length > 0) {
              article.lotSelectionne = lotsAgence[0].id;
              article.peremption = lotsAgence[0].peremption;
              article.prix = lotsAgence[0].prix;
              article.stockAgence = lotsAgence[0].stockAgence;
              article.stockCentral = lotsAgence[0].stockCentral;
            }
          }
          else if ($scope.commande.approvisionnement === 'central') {
            // Mode central uniquement
            article.source = 'central';
            // Appliquer FIFO - prendre le premier lot disponible au central
            const lotsCentral = $scope.lotsDisponibles[designation].filter(lot => lot.stockCentral > 0);
            if (lotsCentral.length > 0) {
              article.lotSelectionne = lotsCentral[0].id;
              article.peremption = lotsCentral[0].peremption;
              article.prix = lotsCentral[0].prix;
              article.stockAgence = lotsCentral[0].stockAgence;
              article.stockCentral = lotsCentral[0].stockCentral;
            }
          }
          else if ($scope.commande.approvisionnement === 'mixte') {
            // Mode mixte - d'abord agence, puis central si insuffisant
            const lotsAgence = $scope.lotsDisponibles[designation].filter(lot => lot.stockAgence > 0);
            const lotsCentral = $scope.lotsDisponibles[designation].filter(lot => lot.stockCentral > 0);

            if (lotsAgence.length > 0 && lotsAgence[0].stockAgence >= quantiteDemandee) {
              // Suffisant en agence
              article.source = 'agence';
              article.lotSelectionne = lotsAgence[0].id;
              article.peremption = lotsAgence[0].peremption;
              article.prix = lotsAgence[0].prix;
              article.stockAgence = lotsAgence[0].stockAgence;
              article.stockCentral = lotsAgence[0].stockCentral;
            }
            else if (lotsCentral.length > 0 && lotsCentral[0].stockCentral >= quantiteDemandee) {
              // Suffisant au central
              article.source = 'central';
              article.lotSelectionne = lotsCentral[0].id;
              article.peremption = lotsCentral[0].peremption;
              article.prix = lotsCentral[0].prix;
              article.stockAgence = lotsCentral[0].stockAgence;
              article.stockCentral = lotsCentral[0].stockCentral;
            }
            else {
              // Mixte - partie en agence, partie au central
              article.source = 'mixte';
              // Pour simplifier, on met tout en central
              if (lotsCentral.length > 0) {
                article.lotSelectionne = lotsCentral[0].id;
                article.peremption = lotsCentral[0].peremption;
                article.prix = lotsCentral[0].prix;
                article.stockAgence = lotsCentral[0].stockAgence;
                article.stockCentral = lotsCentral[0].stockCentral;
              }
            }
          }

          $scope.calculerTotal();
        };

        // Fonction pour sélectionner manuellement un lot
        $scope.selectArticleBC = function (lotId, index) {
          const article = $scope.commande.articles[index];
          const designation = article.designation;

          // Trouver le lot sélectionné
          const lotSelectionne = $scope.lotsDisponibles[designation].find(lot => lot.id === lotId);

          if (lotSelectionne) {
            article.lotSelectionne = lotSelectionne.id;
            article.peremption = lotSelectionne.peremption;
            article.prix = lotSelectionne.prix;

            // Déterminer la source en fonction du stock disponible
            if (lotSelectionne.stockAgence > 0) {
              article.source = 'agence';
              article.stockAgence = lotSelectionne.stockAgence;
              article.stockCentral = lotSelectionne.stockCentral;
            } else if (lotSelectionne.stockCentral > 0) {
              article.source = 'central';
              article.stockAgence = lotSelectionne.stockAgence;
              article.stockCentral = lotSelectionne.stockCentral;
            }

            $("#datepremption" + index).val(article.peremption).trigger('change');
            $scope.calculerTotal();
          }
        };

        // Fonction pour générer les factures proforma selon la source
        // Fonction pour générer les factures proforma selon la source
        $scope.genererFacturesProforma = function () {
          $scope.facturesProforma = [];

          // Regrouper les articles par source
          const articlesParSource = {
            agence: [],
            central: []
          };

          $scope.commande.articles.forEach(article => {
            if (article.source === 'agence') {
              articlesParSource.agence.push(angular.copy(article));
            }
            else if (article.source === 'central') {
              articlesParSource.central.push(angular.copy(article));
            }
            else if (article.source === 'mixte') {
              // Pour les articles en mode mixte, on les split entre agence et central
              const articleAgence = angular.copy(article);
              const articleCentral = angular.copy(article);

              // Ici on devrait calculer la répartition mais pour simplifier, on met tout en central
              articlesParSource.central.push(articleCentral);
            }
          });

          // Créer une facture pour l'agence si nécessaire
          if (articlesParSource.agence.length > 0) {
            const totalAgence = articlesParSource.agence.reduce((total, article) => {
              return total + (article.quantite * article.prix);
            }, 0);

            $scope.facturesProforma.push({
              source: 'agence',
              articles: articlesParSource.agence,
              total: totalAgence
            });
          }

          // Créer une facture pour le central si nécessaire
          if (articlesParSource.central.length > 0) {
            const totalCentral = articlesParSource.central.reduce((total, article) => {
              return total + (article.quantite * article.prix);
            }, 0);

            $scope.facturesProforma.push({
              source: 'central',
              articles: articlesParSource.central,
              total: totalCentral
            });
          }

          // Si une seule facture est générée, s'assurer qu'elle a le bon type
          if ($scope.facturesProforma.length === 1) {
            $scope.facturesProforma[0].source = $scope.commande.approvisionnement;
          }

          console.log('Factures générées:', $scope.facturesProforma);
        };

        // Fonctions du workflow
        $scope.calculerTotal = function () {
          $scope.totalCommande = $scope.commande.articles.reduce(function (total, article) {
            return total + (article.quantite * article.prix);
          }, 0);
        };

        $scope.validerEtape1 = function () {
          // Vérifier que tous les articles ont un lot sélectionné
          const articlesSansLot = $scope.commande.articles.filter(article => !article.lotSelectionne);
          if (articlesSansLot.length > 0) {
            alert('Veuillez sélectionner un lot pour tous les articles avant de valider.');
            return;
          }

          // Générer les factures proforma en fonction des sources
          $scope.genererFacturesProforma();

          $scope.step1Completed = true;
          $scope.activeStep = 2;
        };
        $scope.validerEtape2 = function () {
          $scope.step2Completed = true;
          $scope.activeStep = 3;
        };

        $scope.validerEtape3 = function () {
          $scope.step3Completed = true;
          $scope.activeStep = 4;
        };

        $scope.validerEtape4 = function () {
          $scope.step4Completed = true;
          alert('Commande finalisée avec succès!');
        };

        $scope.rejeterArticle = function (index) {
          if (confirm('Rejeter cet article?')) {
            $scope.commande.articles.splice(index, 1);
            $scope.calculerTotal();
          }
        };

        $scope.rejeterCommande = function () {
          var motif = prompt('Veuillez saisir le motif de rejet:');
          if (motif) {
            $scope.commande.motifModification = motif;
            alert('Commande rejetée avec succès!');
          }
        };

        $scope.imprimerFacture = function () {
          window.print();
        };

        $scope.stockDisponible = function (article) {
          return $scope.stocks[article.designation] || 0;
        };

        $scope.stockSuffisant = function (article) {
          return article.quantite <= $scope.stockDisponible(article);
        };
        // Fonction pour peupler les lots disponibles pour chaque article
        $scope.peuplerLotsDisponibles = function () {
          $scope.commande.articles.forEach(article => {
            const designation = article.designation;
            if ($scope.lotsDisponibles[designation]) {
              // Transformer les objets lot en simples identifiants pour l'affichage
              article.lotsDisponibles = $scope.lotsDisponibles[designation].map(lot => lot.id);
            } else {
              article.lotsDisponibles = [];
            }
          });
        };

        $scope.stockSuffisantPourTous = function () {
          return $scope.commande.articles.every($scope.stockSuffisant);
        };

        // Initialisation
        $scope.calculerTotal();
        $scope.peuplerLotsDisponibles(); // Ajoutez cette ligne

        // Pour chaque article, initialiser la source en fonction du mode d'approvisionnement
        setTimeout(function () {
          $scope.commande.articles.forEach(article => {
            $scope.actualiserSourceArticle(article);
          });
          $scope.$apply();
        }, 200);
      }


      if ($scope.currentTemplateUrl.indexOf("list-validationstep") !== -1) {

        // Variables d'état des étapes
        $scope.etape1Validee = false;
        $scope.etape2Validee = false;
        $scope.etape3Validee = false;
        $scope.etape4Validee = false;
        $scope.etape5Validee = false;

        // Initialiser les variables de scope
        $scope.activeValidationStep = 1;
        $scope.searchClient = '';
        $scope.searchArticle = '';
        $scope.statutFilter = '';
        $scope.commandesRecap = [];
        $scope.commandeSelectionnee = null;

        // Variables pour le rejet avec motif
        $scope.motifRejetachat = '';
        $scope.commandeARejeter = null;

        $scope.uniqueClients = [];

        // Fonctions pour calculer les stocks
        $scope.getStockActuel = function (article) {
          // Simulation de stock actuel (à adapter avec vos données réelles)
          return Math.floor(Math.random() * 10000) + 5000;
        };

        $scope.getStockTotalAccepte = function (article) {
          // Simulation de stock total accepté par GAS (à adapter avec vos données réelles)
          return Math.floor(Math.random() * 8000) + 2000;
        };

        $scope.openModalAffectationDetail = function (article) {
          $scope.articleSelectionne = article;
          $('#modalAffectationDetail').modal('show');
        };

        // Fonction pour mettre à jour la liste des clients unique
        $scope.updateUniqueClients = function () {
          if (!$scope.articlesList || !$scope.articlesList.length) {
            $scope.uniqueClients = [];
            return;
          }
          const clientsMap = {};

          $scope.articlesList.forEach(function (article) {
            if (article.clients && article.clients.length) {
              article.clients.forEach(function (client) {
                if (client && client.nom) {
                  if (!clientsMap[client.nom]) {
                    clientsMap[client.nom] = {
                      nom: client.nom,
                      nbArticles: 0,
                      quantiteTotale: 0
                    };
                  }
                  clientsMap[client.nom].nbArticles++;
                  clientsMap[client.nom].quantiteTotale += client.quantite || 0;
                }
              });
            }
          });

          $scope.uniqueClients = Object.values(clientsMap);
        };

        $scope.afficherMotifRejetOS = function (os) {
          if (os.motifRejet) {
            var typeText = os.typeRejet === 'quantite' ? 'Problème de quantité (Relance GAS)' : 'Problème de lot/péremption (Relance SALAMA)';
            alert('Motif de rejet (' + typeText + '): ' + os.motifRejet);
          }
        };
        // Variables pour le rejet avec motif spécifique
        $scope.motifRejetachat = '';
        $scope.commandeARejeter = null;
        $scope.typeRejet = 'quantite'; // 'quantite' ou 'lot'

        // Fonction pour rejeter un OS avec type spécifique
        $scope.rejeterOSAvecType = function (os, type) {
          $scope.osSelectionne = os;
          $scope.typeRejet = type;
          $("#motifRejetachat").val("");
          $scope.motifRejetachat = '';
          $('#modalMotifRejetOS').modal('show');
        };

        // Confirmer le rejet avec type spécifique
        $scope.confirmerRejetOS = function () {
          $scope.motifRejetachat = $("#motifRejetachat").val();
          if ($scope.motifRejetachat) {
            $scope.osSelectionne.statut = 'rejete';
            $scope.osSelectionne.motifRejet = $scope.motifRejetachat;
            $scope.osSelectionne.typeRejet = $scope.typeRejet;
            $scope.osSelectionne.dateRejet = new Date();

            // Relance automatique selon le type de rejet
            if ($scope.typeRejet === 'quantite') {
              console.log('Relance GAS nécessaire pour: ', $scope.osSelectionne.bailleur.nom);
              // Ici, vous pouvez implémenter la logique de relance GAS
            } else if ($scope.typeRejet === 'lot') {
              console.log('Relance SALAMA nécessaire pour: ', $scope.osSelectionne.bailleur.nom);
              // Ici, vous pouvez implémenter la logique de relance SALAMA
            }

            $('#modalMotifRejetOS').modal('hide');
            $scope.osSelectionne = null;
            $scope.motifRejetachat = '';
          }
        };



        // Filtrer les clients
        $scope.filterClientsSalama = function (client) {
          return !$scope.searchClientSalama ||
            client.nom.toLowerCase().includes($scope.searchClientSalama.toLowerCase());
        };
        // Sélectionner un client
        $scope.clientSelectionne = null;
        $scope.selectClient = function (client) {
          $scope.clientSelectionne = client;
        };

        // Obtenir les articles d'un client spécifique
        $scope.getArticlesByClient = function (clientNom) {
          var articlesDuClient = [];

          $scope.articlesList.forEach(function (article) {
            var clientArticle = article.clients.find(function (c) {
              return c.nom === clientNom;
            });

            if (clientArticle) {
              // Créer une copie de l'article avec les infos spécifiques au client
              var articleAvecClient = angular.copy(article);
              articleAvecClient.quantite = clientArticle.quantite;
              articleAvecClient.dateLivraison = clientArticle.dateLivraison;
              articleAvecClient.datePeremption = clientArticle.datePeremption;
              articleAvecClient.prixUnitaire = clientArticle.prixUnitaire;
              articleAvecClient.quantiteMin = clientArticle.quantiteMin;

              articlesDuClient.push(articleAvecClient);


            }
          });


          /* $scope.uniqueArray = articlesDuClient.filter(function (item, index, self) {
 
             return self.indexOf(item) === index;
           });*/


          $scope.res = articlesDuClient
            .filter(function (item, pos) {
              return articlesDuClient.indexOf(item) == pos;
            });



          articlesDuClient = $scope.res;

          return articlesDuClient;
        };

        $scope.lotsDisponibles = [
          { id: 1, nom: "LOT-001 - Bailleur A" },
          { id: 2, nom: "LOT-002 - Bailleur B" },
          { id: 3, nom: "LOT-003 - Bailleur C" }
        ];

        // Mettre à jour l'affectation quand un lot est sélectionné
        // Remplacer la fonction mettreAJourAffectation par:
        // Mettre à jour l'affectation quand un lot est sélectionné
        $scope.mettreAJourAffectation = function (article, clientNom) {
          console.log('Article affecté:', article.designation, 'Lot:', article.lotSelectionne);

          // Mettre à jour l'article dans la liste principale
          $scope.articlesList.forEach(function (mainArticle) {
            if (mainArticle.id === article.id) {
              mainArticle.lotSelectionne = article.lotSelectionne;
            }
          });

          // Vérifier si tous les articles sont affectés
          $scope.verifierAffectationComplete();
        };

        // Variable pour suivre l'OS ouvert
        $scope.openOSIndex = -1;

        // Fonction pour générer un bordereau OS (simulé)
        $scope.genererBordereauOS = function (os) {
          console.log('Génération du bordereau OS pour:', os.bailleur.nom);
          alert('Bordereau OS généré pour ' + os.bailleur.nom);

          // Simulation de génération de PDF
          var printWindow = window.open('', '_blank');
          printWindow.document.write(`
              <html>
                  <head>
                      <title>Bordereau OS - ${os.bailleur.nom}</title>
                      <style>
                          body { font-family: Arial, sans-serif; margin: 20px; }
                          .header { text-align: center; margin-bottom: 20px; }
                          .info { margin-bottom: 15px; }
                          table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                          th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                          th { background-color: #f2f2f2; }
                          .total { font-weight: bold; }
                      </style>
                  </head>
                  <body>
                      <div class="header">
                          <h2>Ordre de Sortie</h2>
                          <h3>${os.bailleur.nom} - ${os.bailleur.lot}</h3>
                      </div>
                      
                      <div class="info">
                          <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
                          <p><strong>Quantité totale:</strong> ${os.quantiteTotale}</p>
                          <p><strong>Montant total:</strong> ${$scope.getMontantTotalOS(os)}</p>
                      </div>
                      
                      <table>
                          <thead>
                              <tr>
                                  <th>Article</th>
                                  <th>Référence</th>
                                  <th>Quantité</th>
                                  <th>Prix Unitaire</th>
                                  <th>Montant</th>
                              </tr>
                          </thead>
                          <tbody>
                              ${os.articles.map(article => `
                                  <tr>
                                      <td>${article.designation}</td>
                                      <td>${article.ref}</td>
                                      <td>${article.quantite}</td>
                                      <td>${article.prixUnitaire}</td>
                                      <td>${article.quantite * article.prixUnitaire}</td>
                                  </tr>
                              `).join('')}
                          </tbody>
                          <tfoot>
                              <tr class="total">
                                  <td colspan="2">Total</td>
                                  <td>${os.quantiteTotale}</td>
                                  <td colspan="2">${$scope.getMontantTotalOS(os)}</td>
                              </tr>
                          </tfoot>
                      </table>
                      
                      <script>
                          window.onload = function() {
                              window.print();
                          }
                      </script>
                  </body>
              </html>
          `);
          printWindow.document.close();
        };


        // Modifier la fonction verifierAffectationComplete
        // Vérifier si tous les articles sont affectés
        $scope.verifierAffectationComplete = function () {
          var tousAffectes = true;

          // Vérifier dans la liste principale des articles
          for (var i = 0; i < $scope.articlesList.length; i++) {
            var article = $scope.articlesList[i];
            if (!article.lotSelectionne) {
              tousAffectes = false;
              break;
            }
          }

          $scope.etape3Validee = tousAffectes;

          // Éviter de déclencher un nouveau cycle de digest
          if (!$scope.$$phase) {
            $scope.$applyAsync();
          }
        };

        // Affecter tous les articles d'un client
        // Modifier la fonction affecterTousArticles
        $scope.affecterTousArticles = function () {
          if (!$scope.clientSelectionne) return;

          var articles = $scope.getArticlesByClient($scope.clientSelectionne.nom);
          var lotParDefaut = $scope.lotsDisponibles[0].id;

          articles.forEach(function (article) {
            article.lotSelectionne = lotParDefaut;
            $scope.mettreAJourAffectation(article, $scope.clientSelectionne.nom);
          });

          alert('Tous les articles ont été affectés au lot par défaut.');
        };


        // Modifier la fonction rejeterCommande pour ouvrir le modal
        $scope.rejeterCommande = function (commande) {
          $scope.commandeARejeter = commande;
          $("#motifRejetachat").val("");
          $scope.motifRejetachat = ''; // Réinitialiser le motif
          $('#modalMotifRejet').modal('show');
        };

        // Confirmer le rejet avec motif
        $scope.confirmerRejets = function () {
          console.log('Motif de rejet:', $scope.motifRejetachat);
          $scope.motifRejetachat = $("#motifRejetachat").val();
          if ($scope.motifRejetachat) {
            $scope.commandeARejeter.statut = 'rejete';
            $scope.commandeARejeter.motifRejet = $scope.motifRejetachat;
            $scope.commandeARejeter.dateRejet = new Date();

            console.log('Commande rejetée:', $scope.commandeARejeter.id, 'Motif:', $scope.motifRejetachat);

            // Fermer le modal
            $('#modalMotifRejet').modal('hide');

            // Réinitialiser
            $scope.commandeARejeter = null;
            $scope.motifRejetachat = '';
          }
        };

        // Afficher le motif de rejet dans le tableau
        $scope.afficherMotifRejet = function (commande) {
          if (commande.motifRejet) {
            alert('Motif du rejet :\n\n' + commande.motifRejet);
          }
        };


        // ==================== FONCTIONS SPÉCIFIQUES ÉTAPE 5 ====================

        // Variables spécifiques à l'étape 5
        $scope.clientsLivraison = [];
        $scope.openClientIndex = -1;

        // Initialiser les données pour l'étape 5
        // Initialiser les données pour l'étape 5
        $scope.initEtape5Data = function () {
          console.log('Initialisation des données pour l\'étape 5');
          $scope.clientsLivraison = [];

          for (var clientNom in $scope.livraisonParClient) {
            if ($scope.livraisonParClient.hasOwnProperty(clientNom)) {
              var clientData = $scope.livraisonParClient[clientNom];

              var quantiteTotale = clientData.quantiteTotale;
              var montantTotal = clientData.montantTotal;

              var articlesAvecLivraison = clientData.articles.map(function (article) {
                return {
                  ...article,
                  livre: false,
                  quantiteLivree: 0,
                  ecartLivraison: 0,
                  statutLivraison: 'en_attente' // Initialisation explicite
                };
              });

              var clientObj = {
                nom: clientNom,
                articles: articlesAvecLivraison,
                quantiteTotale: quantiteTotale,
                montantTotal: montantTotal,
                quantiteLivree: 0,
                ecartLivraison: 0,
                statutLivraison: 'en_attente', // Initialisation explicite
                livraisonValidee: false,
                livraisonComplete: false
              };

              clientObj.articles.forEach(function (article) {
                article._client = clientObj;
              });

              $scope.clientsLivraison.push(clientObj);
            }
          }

          console.log('Clients livraison initialisés:', $scope.clientsLivraison);
        };

        $scope.setActiveValidationStep = function (step) {
          // Empêcher d'aller à une étape supérieure si les précédentes ne sont pas validées
          if (step > 1 && !$scope.etape1Validee && step > 2) {
            alert('Veuillez d\'abord valider l\'étape 1 (Commandes client)');
            return;
          }
          if (step > 2 && !$scope.etape2Validee && step > 3) {
            alert('Veuillez d\'abord valider l\'étape 2 (Validation GAS)');
            return;
          }
          if (step > 3 && !$scope.etape3Validee && step > 4) {
            alert('Veuillez d\'abord valider l\'étape 3 (Validation SALAMA)');
            return;
          }
          if (step > 4 && !$scope.etape4Validee && step > 5) {
            alert('Veuillez d\'abord valider l\'étape 4 (Validation Bailleur)');
            return;
          }

          $scope.activeValidationStep = step;

          // Initialiser les données spécifiques à l'étape
          if (step === 3) {
            $scope.initEtape3Data();
          }
          else if (step === 4) {
            $scope.initEtape4Data(); // Doit peupler $scope.osList
          }
          else if (step === 5) {
            $scope.initEtape5Data();
          } else if (step === 6) {
            $scope.initEtape6Data();
          }
        };
        // Variables spécifiques à l'étape 6
        $scope.axesExpedition = [];
        $scope.openAxeIndex = -1;
        $scope.transporteursDisponibles = []; // Liste des transporteurs internes
        $scope.transporteursExternes = []; // Liste des transporteurs externes
        // Liste des axes disponibles
        $scope.axesDisponibles = [
          "ALAOTRA MANGORO",
          "AMORON'I MANIA",
          "ATSIMO ANDREFANA",
          "ANALAMANGA",
          "VATOVAVY FITOVINANY",
          "DIANA",
          "SAVA",
          "ITASY",
          "MENABE",
          "BOENY"
        ];
        $scope.etape6Validee = false;

        //  etape 6
        // Initialiser les données pour l'étape 6
        // Initialiser les données pour l'étape 6
        $scope.initEtape6Data = function () {
          console.log('Initialisation des données pour l\'étape 6 - Expédition par Axe');
          $scope.axesExpedition = [];

          // Simuler des axes pour les clients s'ils n'en ont pas
          for (var clientNom in $scope.livraisonParClient) {
            if ($scope.livraisonParClient.hasOwnProperty(clientNom)) {
              var clientData = $scope.livraisonParClient[clientNom];

              // Si le client n'a pas d'axe, lui en attribuer un aléatoirement
              if (!clientData.axe) {
                var randomIndex = Math.floor(Math.random() * $scope.axesDisponibles.length);
                clientData.axe = $scope.axesDisponibles[randomIndex];
              }

              // S'assurer que tous les articles ont un poids
              if (clientData.articles && clientData.articles.length > 0) {
                clientData.articles.forEach(function (article) {
                  if (article.poids === undefined || article.poids === null) {
                    // Simuler un poids si l'article n'en a pas (entre 0.5 et 20 kg)
                    article.poids = Math.random() * 19.5 + 0.5;
                  }
                });

                // Ajuster les quantités pour que le tonnage soit compris entre 1 et 10 tonnes
                var tonnageTotal = 0;
                clientData.articles.forEach(function (article) {
                  var poidsArticle = Number(article.poids) || 0;
                  tonnageTotal += poidsArticle * article.quantite;
                });

                // Si le tonnage total est inférieur à 1 tonne, ajuster les quantités
                if (tonnageTotal < 1000) {
                  clientData.articles.forEach(function (article) {
                    article.quantite += Math.ceil((1000 - tonnageTotal) / (article.poids || 1));
                  });
                }

                // Si le tonnage total est supérieur à 10 tonnes, ajuster les quantités
                if (tonnageTotal > 10000) {
                  clientData.articles.forEach(function (article) {
                    article.quantite = Math.floor(article.quantite * (10000 / tonnageTotal));
                  });
                }
              }

              // Dupliquer le client pour avoir un second client avec le même axe
              var clientDup = angular.copy(clientData);
              clientDup.nom = " district V2"; // Renommer le client dupliqué
              clientDup.axe = clientData.axe; // Assurer que le même axe est utilisé

              // Ajouter le client dupliqué à la livraison
              $scope.livraisonParClient[clientDup.nom] = clientDup;
            }
          }

          // Regrouper les clients par axe
          var clientsParAxe = {};

          for (var clientNom in $scope.livraisonParClient) {
            if ($scope.livraisonParClient.hasOwnProperty(clientNom)) {
              var clientData = $scope.livraisonParClient[clientNom];
              var axe = clientData.axe || "Non assigné";

              if (!clientsParAxe[axe]) {
                clientsParAxe[axe] = {
                  nom: axe,
                  clients: [],
                  tonnageTotal: 0,
                  quantiteTotale: 0,
                  montantTotal: 0,
                  statutExpedition: 'en_attente',
                  expeditionValidee: false,
                  transporteursAffectes: []
                };
              }

              // Calculer le tonnage du client (somme des poids des articles)
              var tonnageClient = 0;
              var articlesAvecPoids = clientData.articles.map(function (article) {
                // S'assurer que le poids est défini et numérique
                var poidsArticle = Number(article.poids) || 0;
                tonnageClient += poidsArticle * article.quantite;

                return {
                  ...article,
                  poids: poidsArticle,
                  livre: false,
                  quantiteLivree: 0,
                  ecartLivraison: 0,
                  statutLivraison: 'en_attente'
                };
              });

              var clientObj = {
                nom: clientNom,
                articles: articlesAvecPoids,
                quantiteTotale: clientData.quantiteTotale,
                montantTotal: clientData.montantTotal,
                tonnage: tonnageClient,
                quantiteLivree: 0,
                ecartLivraison: 0,
                statutLivraison: 'en_attente',
                livraisonValidee: false,
                livraisonComplete: false,
                axe: axe,
                affecte: false
              };

              clientsParAxe[axe].clients.push(clientObj);
              clientsParAxe[axe].tonnageTotal += tonnageClient;
              clientsParAxe[axe].quantiteTotale += clientData.quantiteTotale;
              clientsParAxe[axe].montantTotal += clientData.montantTotal;
            }
          }

          // Convertir l'objet en tableau
          for (var axeNom in clientsParAxe) {
            if (clientsParAxe.hasOwnProperty(axeNom)) {
              $scope.axesExpedition.push(clientsParAxe[axeNom]);
            }
          }

          console.log('Axes expedition initialisés:', $scope.axesExpedition);

          // Charger les transporteurs
          $scope.transporteursDisponibles = [
            { id: 1, nom: "Transporteur Interne 1", tonnageMax: 9000, disponible: true },
            { id: 2, nom: "Transporteur Interne 2", tonnageMax: 10000, disponible: true },
            { id: 3, nom: "Transporteur Interne 3", tonnageMax: 15000, disponible: true },
            { id: 4, nom: "Transporteur Interne 4", tonnageMax: 20000, disponible: true },
            { id: 5, nom: "Transporteur Interne 5", tonnageMax: 30000, disponible: true }
          ];

          $scope.transporteursExternes = [
            { id: 101, nom: "RANDRIASOLOFOHERY Jean Robert 4716FD", tonnageMax: 9000, prix: 100000, disponible: true },
            { id: 102, nom: "Transporteur RAVELOMANANA Narindra 4777TAE", tonnageMax: 9000, prix: 150000, disponible: true },
            { id: 103, nom: "Transporteur RAZAFINDRATSIETY Toky 3266TBP", tonnageMax: 10000, prix: 200000, disponible: true },
            { id: 104, nom: "RANDRIAMBELOZAKA Rijasoa Mbolanirina 2572TBM", tonnageMax: 15000, prix: 250000, disponible: true },
            { id: 105, nom: "ENTREPRISE IAVIANTSOA 5886FE", tonnageMax: 20000, prix: 300000, disponible: true }
          ];
        };


        // Fonction pour générer un BC pour un transporteur
        $scope.genererBCTransporteur = function (affectation) {
          console.log('Génération du BC pour le transporteur:', affectation.transporteur.nom);

          // Calculer le total des articles transportés
          var totalArticles = affectation.clients.reduce(function (total, client) {
            return total + client.articles.reduce(function (sum, article) {
              return sum + article.quantite;
            }, 0);
          }, 0);

          // Calculer le tonnage total
          var tonnageTotal = affectation.clients.reduce(function (total, client) {
            return total + client.tonnage;
          }, 0);

          // Préparer les données du BC
          var bcData = {
            transporteur: affectation.transporteur.nom,
            type: affectation.type,
            date: new Date(),
            tonnageMax: affectation.transporteur.tonnageMax,
            tonnageTransporte: tonnageTotal,
            nombreClients: affectation.clients.length,
            totalArticles: totalArticles,
            prix: affectation.type === 'externe' ? affectation.transporteur.prix : 0,
            clients: affectation.clients.map(function (client) {
              return {
                nom: client.nom,
                tonnage: client.tonnage,
                articles: client.articles.map(function (article) {
                  return {
                    designation: article.designation,
                    quantite: article.quantite,
                    poids: article.poids
                  };
                })
              };
            })
          };

          // Ici, vous pouvez implémenter la génération du PDF
          // Pour l'instant, on affiche un aperçu dans la console
          console.log('BC Généré:', bcData);

          // Ouvrir un modal avec le détail du BC
          $scope.bcSelectionne = bcData;
          $('#modalBCTransporteur').modal('show');
        };



        $scope.genererplanningTransporteur = function (affectation) {
          console.log('Génération du BC pour le transporteur:', affectation.transporteur.nom);

          // Calculer le total des articles transportés
          var totalArticles = affectation.clients.reduce(function (total, client) {
            return total + client.articles.reduce(function (sum, article) {
              return sum + article.quantite;
            }, 0);
          }, 0);

          // Calculer le tonnage total
          var tonnageTotal = affectation.clients.reduce(function (total, client) {
            return total + client.tonnage;
          }, 0);

          // Préparer les données du BC
          var bcData = {
            transporteur: affectation.transporteur.nom,
            type: affectation.type,
            date: new Date(),
            tonnageMax: affectation.transporteur.tonnageMax,
            tonnageTransporte: tonnageTotal,
            nombreClients: affectation.clients.length,
            totalArticles: totalArticles,
            prix: affectation.type === 'externe' ? affectation.transporteur.prix : 0,
            clients: affectation.clients.map(function (client) {
              return {
                nom: client.nom,
                tonnage: client.tonnage,
                articles: client.articles.map(function (article) {
                  return {
                    designation: article.designation,
                    quantite: article.quantite,
                    poids: article.poids
                  };
                })
              };
            })
          };

          // Ici, vous pouvez implémenter la génération du PDF
          // Pour l'instant, on affiche un aperçu dans la console
          console.log('BC Généré:', bcData);

          // Ouvrir un modal avec le détail du BC
          $scope.bcSelectionne = bcData;
          $('#modalplanninTransporteur').modal('show');
        };


        // Fonction pour générer tous les BC d'un axe
        $scope.genererTousBCAxe = function (axe) {
          if (!axe.transporteursAffectes || axe.transporteursAffectes.length === 0) {
            alert('Aucun transporteur affecté à cet axe');
            return;
          }

          console.log('Génération de tous les BC pour l\'axe:', axe.nom);

          // Générer un BC pour chaque transporteur
          axe.transporteursAffectes.forEach(function (affectation) {
            $scope.genererBCTransporteur(affectation);
          });

          alert('BC générés pour tous les transporteurs de l\'axe ' + axe.nom);
        };
        // Fonction pour imprimer le BC
        // Fonction pour imprimer le BC
        $scope.imprimerBC = function () {
          if (!$scope.bcSelectionne) return;

          // Créer une fenêtre d'impression avec le contenu du BC
          var printWindow = window.open('', '_blank');

          // Contenu HTML pour l'impression
          var printContent = `
    <!DOCTYPE html>
    <html>
    <head>
      <title>Bon de Commande - ${$scope.bcSelectionne.transporteur}</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 20px; }
        .footer { border-top: 2px solid #333; padding-top: 20px; margin-top: 30px; }
        .signature { margin-top: 50px; }
        @media print {
          .no-print { display: none; }
          body { margin: 0; padding: 15px; }
        }
      </style>
    </head>
    <body>
      <div class="container">
        <!-- En-tête du BC -->
        <div class="row header">
          <div class="col-6">
            <h2>Bon de Commande Transporteur</h2>
            <p><strong>Date:</strong> ${new Date($scope.bcSelectionne.date).toLocaleDateString('fr-FR')}</p>
            <p><strong>Référence:</strong> BC-${$scope.bcSelectionne.transporteur.substring(0, 3).toUpperCase()}-${new Date($scope.bcSelectionne.date).toLocaleDateString('fr-FR').replace(/\//g, '')}</p>
          </div>
          <div class="col-6 text-end">
            <h3>${$scope.bcSelectionne.transporteur}</h3>
            <p>Transporteur ${$scope.bcSelectionne.type}</p>
            <p><strong>Capacité:</strong> ${$scope.bcSelectionne.tonnageMax} T</p>
          </div>
        </div>
        
        <!-- Détails de la mission -->
        <div class="row mb-4">
          <div class="col-12">
            <h4>Détails de la Mission</h4>
            <div class="row">
              <div class="col-md-4">
                <strong>Tonnage transporté:</strong> ${$scope.formatPoids($scope.bcSelectionne.tonnageTransporte)}
              </div>
              <div class="col-md-4">
                <strong>Nombre de clients:</strong> ${$scope.bcSelectionne.nombreClients}
              </div>
              <div class="col-md-4">
                <strong>Total articles:</strong> ${$scope.bcSelectionne.totalArticles}
              </div>
            </div>
            ${$scope.bcSelectionne.type === 'externe' ? `
            <div class="row mt-2">
              <div class="col-12">
                <strong>Prix convenu:</strong> 
                <span class="text-success fw-bold">${$scope.bcSelectionne.prix} Ar</span>
              </div>
            </div>
            ` : ''}
          </div>
        </div>
        
        <!-- Liste des clients -->
        <div class="row">
          <div class="col-12">
            <h4>Clients à Livrer</h4>
            <table class="table table-bordered">
              <thead class="table-dark">
                <tr>
                  <th>Client</th>
                  <th>Tonnage</th>
                  <th>Nombre d'articles</th>
                </tr>
              </thead>
              <tbody>
                ${$scope.bcSelectionne.clients.map(client => `
                  <tr>
                    <td>${client.nom}</td>
                    <td>${$scope.formatPoids(client.tonnage)}</td>
                    <td>${client.articles.reduce((sum, article) => sum + article.quantite, 0)}</td>
                  </tr>
                `).join('')}
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- Détail des articles par client -->
        <div class="row">
          <div class="col-12">
            <h4>Détail des Articles par Client</h4>
            ${$scope.bcSelectionne.clients.map(client => `
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="mb-0">${client.nom} - ${$scope.formatPoids(client.tonnage)}</h5>
                </div>
                <div class="card-body">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Article</th>
                        <th>Quantité</th>
                        <th>Poids unité</th>
                        <th>Poids total</th>
                      </tr>
                    </thead>
                    <tbody>
                      ${client.articles.map(article => `
                        <tr>
                          <td>${article.designation}</td>
                          <td>${article.quantite}</td>
                          <td>${$scope.formatPoids(article.poids)}</td>
                          <td>${$scope.formatPoids(article.poids * article.quantite)}</td>
                        </tr>
                      `).join('')}
                    </tbody>
                  </table>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
        
        <!-- Conditions -->
        <div class="row footer">
          <div class="col-12">
            <h4>Conditions de Livraison</h4>
            <ol>
              <li>Tous les articles d'un client doivent être livrés en une seule fois</li>
              <li>La livraison doit être effectuée dans les délais convenus</li>
              <li>Le transporteur est responsable de la marchandise jusqu'à la livraison finale</li>
              ${$scope.bcSelectionne.type === 'externe' ? `
              <li>Paiement sous 30 jours après livraison complète et validation</li>
              ` : ''}
            </ol>
          </div>
        </div>
        
        <!-- Signatures -->
        <div class="row signature">
          <div class="col-6">
            <p>Signature du Transporteur</p>
            <p>_________________________</p>
            <p>Nom: ____________________</p>
            <p>Date: ___________________</p>
          </div>
          <div class="col-6">
            <p>Signature du Responsable</p>
            <p>_________________________</p>
            <p>Nom: ____________________</p>
            <p>Date: ___________________</p>
          </div>
        </div>
        
        <div class="row no-print">
          <div class="col-12 text-center mt-3">
            <button class="btn btn-primary" onclick="window.print()">Imprimer</button>
            <button class="btn btn-secondary" onclick="window.close()">Fermer</button>
          </div>
        </div>
      </div>
    </body>
    </html>
  `;

          // Écrire le contenu et ouvrir la fenêtre d'impression
          printWindow.document.write(printContent);
          printWindow.document.close();

          // Attendre que le contenu soit chargé avant d'imprimer
          printWindow.onload = function () {
            printWindow.focus();
            // printWindow.print(); // Décommentez pour imprimer automatiquement
          };
        };

        // Fonction pour valider le BC
        $scope.validerBC = function () {
          if ($scope.bcSelectionne) {
            // Marquer le BC comme validé
            // Ici vous pourriez sauvegarder l'état dans votre base de données
            alert('BC validé pour ' + $scope.bcSelectionne.transporteur);
            $('#modalBCTransporteur').modal('hide');
          }
        };
        // Fonction pour obtenir le coût total des BC externes pour un axe
        $scope.getCoutTotalBCExterne = function (axe) {
          if (!axe.transporteursAffectes || axe.transporteursAffectes.length === 0) return 0;

          return axe.transporteursAffectes.reduce(function (total, affectation) {
            if (affectation.type === 'externe') {
              return total + (affectation.transporteur.prix || 0);
            }
            return total;
          }, 0);
        };


        // Formater l'affichage du poids
        // Formater l'affichage du poids avec gestion des valeurs undefined/null
        $scope.formatPoids = function (poids) {
          if (poids === undefined || poids === null || isNaN(poids)) {
            return '0.00 kg'; // Valeur par défaut si poids est indéfini
          }

          if (poids >= 1000) {
            let op = (poids / 1000);
            let opintvalue = parseInt(op);
            return opintvalue + ' T';
          } else {
            return parseInt(poids) + ' kg';
          }
        };

        // Fonctions spécifiques à l'étape 6
        $scope.affecterTransporteur = function (axe) {
          // Ouvrir un modal pour choisir un transporteur
          $scope.axeSelectionne = axe;
          $('#modalChoixTransporteur').modal('show');
        };

        // Fonction pour vérifier si on peut ajouter un transporteur supplémentaire
        $scope.canAddTransporteur = function (transporteur) {
          if (!transporteur.disponible) return false;

          // Calculer le tonnage déjà couvert par les transporteurs affectés
          var tonnageDejaCouvert = 0;
          if ($scope.axeSelectionne.transporteursAffectes && $scope.axeSelectionne.transporteursAffectes.length > 0) {
            tonnageDejaCouvert = $scope.axeSelectionne.transporteursAffectes.reduce(function (total, affectation) {
              return total + affectation.transporteur.tonnageMax;
            }, 0);
          }

          // Vérifier si le tonnage total est déjà couvert
          var tonnageRestant = $scope.axeSelectionne.tonnageTotal - tonnageDejaCouvert;
          if (tonnageRestant <= 0) return false;

          return true;
        };

        // Fonction pour choisir un transporteur interne

        // Fonction pour choisir un transporteur interne
        $scope.choisirTransporteurInterne = function (transporteur) {
          if ($scope.canAddTransporteur(transporteur)) {
            // Calculer le tonnage déjà couvert
            var tonnageDejaCouvert = $scope.getTonnageCouvert($scope.axeSelectionne);
            var tonnageRestant = $scope.axeSelectionne.tonnageTotal - tonnageDejaCouvert;

            // Vérifier si ce transporteur peut prendre au moins un client complet
            var clientsAffectables = $scope.getClientsNonAffectes($scope.axeSelectionne);

            // Conversion en syntaxe AngularJS compatible
            var tonnagesClients = clientsAffectables.map(function (client) {
              return client.tonnage;
            });
            var tonnageMinClient = tonnagesClients.length > 0 ? Math.min.apply(Math, tonnagesClients) : 0;

            var clientAffectable = clientsAffectables.find(function (client) {
              return client.tonnage <= transporteur.tonnageMax && client.tonnage <= tonnageRestant;
            });

            if (!clientAffectable && clientsAffectables.length > 0) {
              alert('Ce transporteur ne peut pas prendre un client complet. Le tonnage minimum pour un client est de ' +
                $scope.formatPoids(tonnageMinClient) +
                ' et ce transporteur a une capacité de ' + $scope.formatPoids(transporteur.tonnageMax));
              return;
            }

            // Affecter le transporteur à l'axe avec les clients qu'il peut prendre
            var affectation = {
              type: 'interne',
              transporteur: transporteur,
              dateAffectation: new Date(),
              clients: []
            };

            // Trouver les clients qui peuvent être affectés à ce transporteur
            var tonnageTransporteur = 0;
            var clientsAffectes = [];

            for (var i = 0; i < clientsAffectables.length && tonnageTransporteur < transporteur.tonnageMax; i++) {
              var client = clientsAffectables[i];
              if (tonnageTransporteur + client.tonnage <= transporteur.tonnageMax) {
                clientsAffectes.push(client);
                tonnageTransporteur += client.tonnage;
                client.affecte = true; // Marquer le client comme affecté
              }
            }

            affectation.clients = clientsAffectes;
            $scope.axeSelectionne.transporteursAffectes.push(affectation);

            // Marquer le transporteur comme indisponible
            transporteur.disponible = false;

            // Vérifier si le tonnage total est maintenant couvert
            var tonnageCouvert = $scope.getTonnageCouvert($scope.axeSelectionne);

            if (tonnageCouvert >= $scope.axeSelectionne.tonnageTotal) {
              // Tonnage total couvert, on peut fermer le modal
              $('#modalChoixTransporteur').modal('hide');
            }
          }
        };
        // Fonction pour calculer le coût total des transporteurs externes pour un axe
        $scope.getCoutTotalExterne = function (axe) {
          if (!axe.transporteursAffectes || axe.transporteursAffectes.length === 0) return 0;

          return axe.transporteursAffectes.reduce(function (total, affectation) {
            if (affectation.type === 'externe') {
              return total + (affectation.transporteur.prix || 0);
            }
            return total;
          }, 0);
        };
        $scope.getTonnageAffectation = function (affectation) {
          if (!affectation.clients || affectation.clients.length === 0) return 0;

          return affectation.clients.reduce(function (sum, client) {
            return sum + (client.tonnage || 0);
          }, 0);
        };
        // Fonction pour obtenir le nombre de transporteurs par type
        $scope.getNombreTransporteurs = function (axe, type) {
          if (!axe.transporteursAffectes || axe.transporteursAffectes.length === 0) return 0;

          return axe.transporteursAffectes.filter(function (affectation) {
            return affectation.type === type;
          }).length;
        };
        $scope.formatMontant = function (montant) {
          if (montant === undefined || montant === null || isNaN(montant)) {
            return '0';
          }

          return Number(montant).toLocaleString('fr-FR');
        };
        // Fonction pour choisir un transporteur externe
        $scope.choisirTransporteurExterne = function (transporteur) {
          if ($scope.canAddTransporteur(transporteur)) {
            // Calculer le tonnage déjà couvert
            var tonnageDejaCouvert = $scope.getTonnageCouvert($scope.axeSelectionne);
            var tonnageRestant = $scope.axeSelectionne.tonnageTotal - tonnageDejaCouvert;

            // Récupérer les clients non affectés
            var clientsAffectables = $scope.getClientsNonAffectes($scope.axeSelectionne);

            // Affecter le transporteur à l'axe avec les clients qu'il peut prendre
            var affectation = {
              type: 'externe',
              transporteur: transporteur,
              dateAffectation: new Date(),
              clients: []
            };

            // Trouver les clients qui peuvent être affectés à ce transporteur
            var tonnageTransporteur = 0;
            var clientsAffectes = [];

            for (var i = 0; i < clientsAffectables.length && tonnageTransporteur < transporteur.tonnageMax; i++) {
              var client = clientsAffectables[i];
              // Ajouter le client sans vérification
              clientsAffectes.push(client);
              tonnageTransporteur += client.tonnage;
              client.affecte = true; // Marquer le client comme affecté
            }

            affectation.clients = clientsAffectes;
            $scope.axeSelectionne.transporteursAffectes.push(affectation);

            // Vérifier si le tonnage total est maintenant couvert
            var tonnageCouvert = $scope.getTonnageCouvert($scope.axeSelectionne);

            if (tonnageCouvert >= $scope.axeSelectionne.tonnageTotal) {
              // Tonnage total couvert, on peut fermer le modal
              $('#modalChoixTransporteur').modal('hide');
            }
          }
        };



        // Fonction pour obtenir les clients non encore affectés
        $scope.getClientsNonAffectes = function (axe) {
          return axe.clients.filter(function (client) {
            return !client.affecte;
          });
        };


        // Fonction pour calculer le tonnage déjà couvert
        $scope.getTonnageCouvert = function (axe) {
          if (!axe.transporteursAffectes || axe.transporteursAffectes.length === 0) return 0;

          return axe.transporteursAffectes.reduce(function (total, affectation) {
            var tonnageAffectation = affectation.clients.reduce(function (sum, client) {
              return sum + client.tonnage;
            }, 0);
            return total + tonnageAffectation;
          }, 0);
        };

        // Fonction pour réinitialiser l'affectation d'un axe
        $scope.reinitialiserAffectation = function (axe) {
          if (confirm('Êtes-vous sûr de vouloir réinitialiser l\'affectation des transporteurs pour cet axe ?')) {
            axe.transporteursAffectes = [];

            // Rendre tous les transporteurs à nouveau disponibles
            $scope.transporteursDisponibles.forEach(function (transporteur) {
              transporteur.disponible = true;
            });

            // Réinitialiser le statut d'affectation des clients
            axe.clients.forEach(function (client) {
              client.affecte = false;
            });
          }
        };
        // Fonction pour calculer le tonnage restant
        $scope.getTonnageRestant = function (axe) {
          var tonnageCouvert = $scope.getTonnageCouvert(axe);
          return Math.max(0, axe.tonnageTotal - tonnageCouvert);
        };
        // Valider l'expédition d'un axe
        // Valider l'expédition d'un axe
        $scope.validerExpeditionAxe = function (axe) {
          var tonnageCouvert = $scope.getTonnageCouvert(axe);
          var tousClientsAffectes = axe.clients.every(function (client) {
            return client.affecte;
          });

          if (tousClientsAffectes && tonnageCouvert >= axe.tonnageTotal) {
            axe.expeditionValidee = true;
            axe.statutExpedition = 'complet';

            // Vérifier si toutes les expéditions sont validées
            var toutesValidees = $scope.axesExpedition.every(function (a) {
              return a.expeditionValidee;
            });

            if (toutesValidees) {
              $scope.etape6Validee = true;
            }

            alert('Expédition validée pour l\'axe ' + axe.nom);
          } else {
            var message = 'Impossible de valider l\'expédition. ';

            if (!tousClientsAffectes) {
              var clientsNonAffectes = axe.clients.filter(function (client) {
                return !client.affecte;
              });
              message += clientsNonAffectes.length + ' client(s) non affecté(s). ';
            }

            if (tonnageCouvert < axe.tonnageTotal) {
              message += 'Tonnage insuffisant. ';
            }

            alert(message);
          }
        };


        $scope.getStatutExpeditionText = function (statut) {
          switch (statut) {
            case 'complet': return 'Complet';
            case 'partiel': return 'Partiel';
            case 'en_attente':
            default: return 'En attente';
          }
        };

        $scope.getAxesEnAttenteExpedition = function () {
          return $scope.axesExpedition.filter(function (axe) {
            return axe.statutExpedition === 'en_attente';
          });
        };

        $scope.getAxesExpeditionComplete = function () {
          return $scope.axesExpedition.filter(function (axe) {
            return axe.statutExpedition === 'complet';
          });
        };

        $scope.getAxesExpeditionPartielle = function () {
          return $scope.axesExpedition.filter(function (axe) {
            return axe.statutExpedition === 'partiel';
          });
        };

        // Fonction pour mettre à jour le statut de livraison d'un article
        $scope.updateStatutArticleLivraison = function (article) {
          if (article.livre) {
            if (article.quantiteLivree === article.quantite) {
              article.statutLivraison = 'complet';
            } else if (article.quantiteLivree > 0) {
              article.statutLivraison = 'partiel';
            } else {
              article.quantiteLivree = article.quantite;
              article.statutLivraison = 'complet';
            }
          } else {
            article.quantiteLivree = 0;
            article.statutLivraison = 'en_attente';
          }

          // Mettre à jour le statut du client
          $scope.updateStatutClientLivraison(article._client);
        };

        // Fonction pour calculer l'écart de livraison
        $scope.calculerEcartLivraison = function (article) {
          article.ecartLivraison = article.quantiteLivree - article.quantite;
          $scope.updateStatutArticleLivraison(article);
        };

        // Fonction pour mettre à jour le statut de livraison d'un client
        $scope.updateStatutClientLivraison = function (client) {
          var articlesLivres = client.articles.filter(function (article) {
            return article.livre;
          });

          var articlesComplets = client.articles.filter(function (article) {
            return article.statutLivraison === 'complet';
          });

          if (articlesComplets.length === client.articles.length) {
            client.statutLivraison = 'complet';
            client.livraisonComplete = true;
          } else if (articlesLivres.length > 0) {
            client.statutLivraison = 'partiel';
            client.livraisonComplete = false;
          } else {
            client.statutLivraison = 'en_attente';
            client.livraisonComplete = false;
          }

          // Calculer les totaux de livraison du client
          client.quantiteLivree = client.articles.reduce(function (total, article) {
            return total + (article.quantiteLivree || 0);
          }, 0);

          client.ecartLivraison = client.quantiteLivree - client.quantiteTotale;
        };

        // Fonction pour obtenir le texte du statut de livraison
        $scope.getStatutLivraisonText = function (statut) {
          switch (statut) {
            case 'complet': return 'Complet';
            case 'partiel': return 'Partiel';
            case 'en_attente':
            default: return 'En attente';
          }
        };

        // Fonction pour obtenir le texte du statut de livraison d'un article
        $scope.getStatutArticleLivraisonText = function (statut) {
          switch (statut) {
            case 'complet': return 'Complet';
            case 'partiel': return 'Partiel';
            case 'en_attente':
            default: return 'En attente';
          }
        };
        // Fonction pour valider toutes les expéditions
        $scope.validerToutesExpeditions = function () {
          // Vérifier que tous les axes ont des transporteurs affectés
          var axesSansTransporteur = $scope.axesExpedition.filter(function (axe) {
            return axe.transporteursAffectes.length === 0;
          });

          if (axesSansTransporteur.length > 0) {
            alert('Certains axes n\'ont pas de transporteurs affectés : ' +
              axesSansTransporteur.map(function (a) { return a.nom; }).join(', '));
            return;
          }

          // Vérifier que le tonnage est couvert pour tous les axes
          var axesTonnageInsuffisant = $scope.axesExpedition.filter(function (axe) {
            return $scope.getTonnageCouvert(axe) < axe.tonnageTotal;
          });

          if (axesTonnageInsuffisant.length > 0) {
            alert('Tonnage insuffisant pour les axes : ' +
              axesTonnageInsuffisant.map(function (a) { return a.nom; }).join(', '));
            return;
          }

          // Vérifier que tous les articles sont livrés
          var clientsNonLivres = [];
          $scope.axesExpedition.forEach(function (axe) {
            axe.clients.forEach(function (client) {
              var articlesNonLivres = client.articles.filter(function (article) {
                return !article.livre || article.statutLivraison !== 'complet';
              });

              if (articlesNonLivres.length > 0) {
                clientsNonLivres.push(client.nom);
              }
            });
          });

          if (clientsNonLivres.length > 0) {
            alert('Certains clients ont des articles non livrés : ' + clientsNonLivres.join(', '));
            return;
          }

          // Si toutes les validations passent, marquer l'étape comme validée
          $scope.axesExpedition.forEach(function (axe) {
            axe.expeditionValidee = true;
            axe.statutExpedition = 'complet';
          });

          $scope.etape6Validee = true;
          alert('Toutes les expéditions ont été validées avec succès !');
        };

        // Fonction pour obtenir les axes en attente d'expédition
        $scope.getAxesEnAttenteExpedition = function () {
          return $scope.axesExpedition.filter(function (axe) {
            return !axe.expeditionValidee;
          });
        };

        // Fonction pour obtenir les axes avec expédition complète
        $scope.getAxesExpeditionComplete = function () {
          return $scope.axesExpedition.filter(function (axe) {
            return axe.expeditionValidee;
          });
        };

        // Fonction pour obtenir les axes avec expédition partielle
        $scope.getAxesExpeditionPartielle = function () {
          return $scope.axesExpedition.filter(function (axe) {
            return axe.transporteursAffectes.length > 0 && !axe.expeditionValidee;
          });
        };



        // Fonctions utilitaires pour la livraison
        $scope.getStatutLivraisonText = function (statut) {
          if (!statut) return 'En attente';

          var statuts = {
            'en_attente': 'En attente',
            'partiel': 'Partiel',
            'complet': 'Complet'
          };
          return statuts[statut] || statut;
        };

        $scope.getStatutArticleLivraisonText = function (statut) {
          if (!statut) return 'En attente';

          var statuts = {
            'en_attente': 'En attente',
            'partiel': 'Partiel',
            'complet': 'Complet'
          };
          return statuts[statut] || statut;
        };

        $scope.getClientsLivraisonComplete = function () {
          return $scope.clientsLivraison.filter(function (client) {
            return client.statutLivraison === 'complet';
          });
        };

        $scope.getClientsLivraisonPartielle = function () {
          return $scope.clientsLivraison.filter(function (client) {
            return client.statutLivraison === 'partiel';
          });
        };

        $scope.getClientsEnAttenteLivraison = function () {
          return $scope.clientsLivraison.filter(function (client) {
            return client.statutLivraison === 'en_attente';
          });
        };

        // Mettre à jour le statut de livraison d'un article
        $scope.updateStatutArticleLivraison = function (article) {
          if (article.livre) {
            // Si on marque comme livré, mettre la quantité livrée égale à la quantité commandée par défaut
            article.quantiteLivree = article.quantiteLivree || article.quantite;
            article.ecartLivraison = 0;
            article.statutLivraison = 'complet';
          } else {
            // Si on démare comme non livré, réinitialiser
            article.quantiteLivree = 0;
            article.ecartLivraison = -article.quantite;
            article.statutLivraison = 'en_attente';
          }

          // Mettre à jour les totaux du client
          $scope.mettreAJourTotauxClient(article._client);
        };

        // Calculer l'écart de livraison
        $scope.calculerEcartLivraison = function (article) {
          article.ecartLivraison = article.quantiteLivree - article.quantite;

          // Mettre à jour le statut en fonction de la quantité livrée
          if (article.quantiteLivree === 0) {
            article.statutLivraison = 'en_attente';
            article.livre = false;
          } else if (article.quantiteLivree === article.quantite) {
            article.statutLivraison = 'complet';
            article.livre = true;
          } else {
            article.statutLivraison = 'partiel';
            article.livre = true;
          }

          // Mettre à jour les totaux du client
          $scope.mettreAJourTotauxClient(article._client);
        };

        // Mettre à jour les totaux d'un client
        $scope.mettreAJourTotauxClient = function (client) {
          var quantiteLivree = 0;
          var ecartLivraison = 0;
          var tousComplets = true;
          var aucunLivree = true;

          client.articles.forEach(function (article) {
            quantiteLivree += article.quantiteLivree;
            ecartLivraison += article.ecartLivraison;

            if (article.statutLivraison !== 'complet') {
              tousComplets = false;
            }

            if (article.quantiteLivree > 0) {
              aucunLivree = false;
            }
          });

          client.quantiteLivree = quantiteLivree;
          client.ecartLivraison = ecartLivraison;

          // Mettre à jour le statut global du client
          if (tousComplets) {
            client.statutLivraison = 'complet';
            client.livraisonComplete = true;
          } else if (aucunLivree) {
            client.statutLivraison = 'en_attente';
            client.livraisonComplete = false;
          } else {
            client.statutLivraison = 'partiel';
            client.livraisonComplete = false;
          }
        };

        // Valider la livraison d'un client
        $scope.validerLivraisonClient = function (client) {
          if (confirm('Valider la livraison pour le client ' + client.nom + ' ?')) {
            client.livraisonValidee = true;
            console.log('Livraison validée pour:', client.nom);
          }
        };

        // Vérifier si on peut valider la livraison d'un client
        $scope.canValidateLivraison = function (client) {
          return !client.livraisonValidee && client.quantiteLivree > 0;
        };

        // Marquer tous les articles comme livrés pour un client
        $scope.marquerToutLivre = function (client) {
          client.articles.forEach(function (article) {
            article.livre = true;
            article.quantiteLivree = article.quantite;
            article.ecartLivraison = 0;
            article.statutLivraison = 'complet';
          });

          $scope.mettreAJourTotauxClient(client);
        };

        // Marquer partiellement livré pour un client
        $scope.marquerPartielLivre = function (client) {
          client.articles.forEach(function (article) {
            if (!article.livre) {
              article.livre = true;
              article.quantiteLivree = Math.floor(article.quantite * 0.8); // 80% par défaut
              article.ecartLivraison = article.quantiteLivree - article.quantite;
              article.statutLivraison = 'partiel';
            }
          });

          $scope.mettreAJourTotauxClient(client);
        };

        // Valider toutes les livraisons
        $scope.validerToutesLivraisons = function () {
          if (confirm('Valider toutes les livraisons en attente ?')) {
            $scope.clientsLivraison.forEach(function (client) {
              if (!client.livraisonValidee && client.quantiteLivree > 0) {
                client.livraisonValidee = true;
              }
            });
            alert('Toutes les livraisons ont été validées avec succès!');
          }
        };

        // Finaliser le processus
        $scope.finaliserProcessus = function () {
          if (confirm('Finaliser l\'ensemble du processus de commande et livraison ?')) {
            $scope.etape5Validee = true;
            alert('Processus finalisé avec succès! Toutes les étapes sont terminées.');
          }
        };

        // Générer un bordereau (simulé)
        $scope.genererBordereau = function (client) {
          console.log('Génération du bordereau pour:', client.nom);
          alert('Bordereau généré pour ' + client.nom);
        };

        // Voir l'historique (simulé)
        $scope.voirHistorique = function (client) {
          console.log('Voir historique pour:', client.nom);
          alert('Ouverture de l\'historique pour ' + client.nom);
        };


        // Fonction pour soumettre l'affectation et passer à l'étape 4
        $scope.soumettreAffectation = function () {
          if (!$scope.etape3Validee) {
            alert('Veuillez d\'abord affecter tous les articles aux bailleurs.');
            return;
          }

          // Vérifier que tous les articles ont été affectés
          var articlesNonAffectes = $scope.articlesList.filter(function (article) {
            return !article.lotSelectionne;
          });

          if (articlesNonAffectes.length > 0) {
            alert('Certains articles n\'ont pas été affectés à un bailleur. Veuillez compléter l\'affectation.');
            return;
          }

          // Créer les objets OS et Livraison
          var osParBailleur = $scope.creerOSParBailleur();
          var livraisonParClient = $scope.creerLivraisonParClient();

          // Afficher les objets dans la console
          console.log('OS par Bailleur:', osParBailleur);
          console.log('Livraison par Client:', livraisonParClient);

          // Stocker les données pour les utiliser dans l'étape 4
          $scope.osParBailleur = osParBailleur;
          $scope.livraisonParClient = livraisonParClient;

          // Passer à l'étape 4
          $scope.setActiveValidationStep(4);
          alert('Affectation soumise avec succès! Passage à l\'étape 4.');
        };
        // ==================== FONCTIONS SPÉCIFIQUES ÉTAPE 4 ====================

        // Variables spécifiques à l'étape 4
        $scope.osList = [];
        $scope.osSelectionne = null;

        // Initialiser les données pour l'étape 4
        // Initialiser les données pour l'étape 4
        $scope.initEtape4Data = function () {
          console.log('Initialisation des données pour l\'étape 4');
          // Vérifier que osParBailleur existe et n'est pas vide
          if (!$scope.osParBailleur || Object.keys($scope.osParBailleur).length === 0) {
            console.warn('Aucun OS à afficher - osParBailleur est vide');
            $scope.osList = [];
            $scope.etape4Validee = false;
            return;
          }
          // Créer la liste des OS à partir des données générées à l'étape 3
          // Créer la liste des OS à partir des données générées à l'étape 3
          $scope.osList = [];

          // Parcourir tous les OS par bailleur
          // Parcourir tous les OS par bailleur
          // Parcourir tous les OS par bailleur
          for (var bailleurId in $scope.osParBailleur) {
            if ($scope.osParBailleur.hasOwnProperty(bailleurId)) {
              var osData = $scope.osParBailleur[bailleurId];

              // Ajouter l'OS à la liste avec le statut par défaut
              $scope.osList.push({
                id: osData.bailleur.id,
                bailleur: osData.bailleur,
                clients: osData.clients,
                quantiteTotale: osData.quantiteTotale,
                montantTotal: osData.montantTotal,
                nbClients: osData.nbClients || osData.clients.length,
                statut: 'en_attente' // Statut par défaut pour l'OS
              });
            }
          }

          $scope.updateClientsOS();

          console.log('OS list initialisée:', $scope.osList);
        };

        // Fonctions utilitaires pour les OS
        $scope.getStatutOSText = function (statut) {
          var statuts = {
            'en_attente': 'En attente',
            'a_signee': 'À signer',
            'uploadé': 'Uploadé',
            'valide': 'Validé',
            'rejete': 'Rejeté',
            'modifie': 'Modifié'
          };
          return statuts[statut] || statut;
        };



        $scope.getOSValides = function () {
          return $scope.osList.filter(function (os) { return os.statut === 'valide'; });
        };

        $scope.getOSEnAttente = function () {
          if (!$scope.osList || !Array.isArray($scope.osList)) {
            return [];
          }
          return $scope.osList.filter(function (os) {
            return os.statut === 'en_attente';
          });
        };

        $scope.getOSRejetes = function () {
          return $scope.osList.filter(function (os) { return os.statut === 'rejete'; });
        };

        $scope.getMontantTotalOS = function (os) {
          return os.articles.reduce(function (total, article) {
            return total + (article.quantite * article.prixUnitaire);
          }, 0);
        };

        // Actions sur les OS
        $scope.afficherDetailsOS = function (os) {
          $scope.osSelectionne = os;
        };

        // Fonction pour valider définitivement l'OS du bailleur
        $scope.validerOS = function (os) {
          if (os.statut === 'uploadé' || os.statut === 'a_signee') {
            os.statut = 'valide';
            os.dateValidation = new Date();

            // Marquer tous les articles comme validés
            os.clients.forEach(function (client) {
              client.articles.forEach(function (article) {
                article.statut = 'valide';
              });
            });

            alert('OS validé définitivement!');

            // Vérifier si tous les OS sont validés pour activer la génération des BC
          } else {
            alert('Veuillez d\'abord signer et uploader l\'OS avant de valider.');
          }
        };

        $scope.rejeterOS = function (os) {
          if (confirm('Rejeter cet OS pour le bailleur ' + os.bailleur.nom + ' ?')) {
            os.statut = 'rejete';
            // Marquer aussi tous les articles comme rejetés
            os.articles.forEach(function (article) {
              article.statut = 'rejete';
            });
            console.log('OS rejeté:', os);
          }
        };

        $scope.modifierOS = function (os) {
          os.statut = 'modifie';
          console.log('OS modifié:', os);
          alert('OS marqué comme modifié. Des ajustements peuvent être nécessaires.');
        };

        // Fonction pour valider tous les OS
        $scope.validerTousOS = function () {
          if (confirm('Passez a la livraison ?')) {
            $scope.setActiveValidationStep(5);
            alert('Tous les OS ont été validés avec succès!');
          }
        };


        // Créer l'objet OS groupé par bailleur avec informations clients
        // Créer l'objet OS groupé par bailleur avec structure {bailleur: {clients: [articles]}}
        $scope.creerOSParBailleur = function () {
          var osParBailleur = {};

          // Parcourir tous les articles
          $scope.articlesList.forEach(function (article) {
            // Vérifier si l'article a été affecté à un bailleur
            if (article.lotSelectionne) {
              // Trouver le bailleur correspondant au lot sélectionné
              var bailleurId = article.lotSelectionne;
              var bailleur = $scope.lotsDisponibles.find(function (lot) {
                return lot.id === bailleurId;
              });

              if (bailleur) {
                // Extraire l'ID du bailleur du nom du lot
                var lotParts = bailleur.nom.split(' - ');
                var lotNumber = lotParts[0];
                var bailleurNom = lotParts[1] || bailleur.nom;

                // Initialiser le bailleur s'il n'existe pas encore
                if (!osParBailleur[bailleurId]) {
                  osParBailleur[bailleurId] = {
                    bailleur: {
                      id: bailleurId,
                      nom: bailleurNom,
                      lot: lotNumber
                    },
                    clients: {}, // Utiliser un objet pour regrouper par client
                    quantiteTotale: 0,
                    montantTotal: 0,
                    nbClients: 0
                  };
                }

                // Parcourir tous les clients de cet article
                article.clients.forEach(function (client) {
                  // Initialiser le client s'il n'existe pas encore
                  if (!osParBailleur[bailleurId].clients[client.nom]) {
                    osParBailleur[bailleurId].clients[client.nom] = {
                      nom: client.nom,
                      articles: [],
                      quantiteTotale: 0,
                      montantTotal: 0
                    };
                    osParBailleur[bailleurId].nbClients++;
                  }

                  // Créer l'objet article avec les informations du client
                  var articleAvecClient = {
                    id: article.id,
                    designation: article.designation,
                    ref: article.ref,
                    quantite: client.quantite,
                    prixUnitaire: article.prixUnitaire,
                    datePeremption: client.datePeremption,
                    dateLivraison: client.dateLivraison,
                    lot: lotNumber, // Ajouter le lot ici
                    statut: 'en_attente' // Statut par défaut
                  };

                  // Ajouter l'article au client
                  osParBailleur[bailleurId].clients[client.nom].articles.push(articleAvecClient);

                  // Mettre à jour les totaux du client
                  osParBailleur[bailleurId].clients[client.nom].quantiteTotale += client.quantite;
                  osParBailleur[bailleurId].clients[client.nom].montantTotal += client.quantite * article.prixUnitaire;

                  // Mettre à jour les totaux du bailleur
                  osParBailleur[bailleurId].quantiteTotale += client.quantite;
                  osParBailleur[bailleurId].montantTotal += client.quantite * article.prixUnitaire;
                });
              }
            }
          });

          // Convertir l'objet clients en array pour faciliter l'itération
          for (var bailleurId in osParBailleur) {
            osParBailleur[bailleurId].clients = Object.values(osParBailleur[bailleurId].clients);
          }

          return osParBailleur;
        };

        // Créer l'objet Livraison groupé par client
        // Créer l'objet Livraison groupé par client
        $scope.creerLivraisonParClient = function () {
          var livraisonParClient = {};

          // Parcourir tous les articles
          $scope.articlesList.forEach(function (article) {
            // Parcourir tous les clients de cet article
            article.clients.forEach(function (client) {
              // Initialiser le client s'il n'existe pas encore
              if (!livraisonParClient[client.nom]) {
                livraisonParClient[client.nom] = {
                  client: client.nom,
                  articles: [],
                  quantiteTotale: 0,
                  montantTotal: 0
                };
              }

              // Ajouter l'article au client seulement si il a été affecté à un bailleur
              if (article.lotSelectionne) {
                livraisonParClient[client.nom].articles.push({
                  id: article.id,
                  designation: article.designation,
                  ref: article.ref,
                  quantite: client.quantite,
                  prixUnitaire: client.prixUnitaire,
                  dateLivraison: client.dateLivraison,
                  datePeremption: client.datePeremption,
                  bailleurId: article.lotSelectionne // Ajouter l'ID du bailleur
                });

                // Mettre à jour les totaux
                livraisonParClient[client.nom].quantiteTotale += client.quantite;
                livraisonParClient[client.nom].montantTotal += client.quantite * client.prixUnitaire;
              }
            });
          });

          return livraisonParClient;
        };



        // ==================== DÉFINIR D'ABORD LES FONCTIONS UTILITAIRES ====================

        // Méthodes utilitaires - DÉFINIR AVANT de les utiliser
        $scope.getStatutText = function (statut) {
          var statuts = {
            'en_attente': 'En attente',
            'valide': 'Validé',
            'rejete': 'Rejeté',
            'modifie': 'Modifié'
          };
          return statuts[statut] || statut;
        };

        $scope.getCommandesValidees = function () {
          return $scope.commandesRecap.filter(function (c) { return c.statut === 'valide'; });
        };

        $scope.getCommandesEnAttente = function () {
          return $scope.commandesRecap.filter(function (c) { return c.statut === 'en_attente'; });
        };

        $scope.getCommandesModifiees = function () {
          return $scope.commandesRecap.filter(function (c) { return c.statut === 'modifie'; });
        };

        $scope.getCommandesRejetees = function () {
          return $scope.commandesRecap.filter(function (c) { return c.statut === 'rejete'; });
        };

        $scope.getArticlesEnAttente = function () {
          return $scope.articlesList ? $scope.articlesList.filter(function (article) {
            return article.quantiteAffectee < article.quantiteTotale;
          }) : [];
        };

        // ==================== FONCTIONS PRINCIPALES ====================

        // Modifier la fonction d'équilibrage pour mieux gérer la répartition
        $scope.equilibrerQuantites = function () {
          var totalActuel = $scope.getTotalAffecte();
          var totalSouhaite = $scope.articleSelectionne?.quantiteTotale;
          var difference = totalSouhaite - totalActuel;

          if (difference === 0) return;

          // Trouver les bailleurs sélectionnés valides
          var bailleursValides = $scope.bailleursList.filter(function (bailleur) {
            return bailleur.selected && $scope.isQuantiteValide(bailleur);
          });

          if (bailleursValides.length === 0) return;

          // Répartir la différence proportionnellement selon la capacité de chaque bailleur
          var capaciteTotale = bailleursValides.reduce(function (total, bailleur) {
            return total + (bailleur.stockActuel - bailleur.commandesEnCours - bailleur.quantiteAffectee);
          }, 0);

          if (capaciteTotale <= 0) return;

          bailleursValides.forEach(function (bailleur) {
            var capaciteBailleur = bailleur.stockActuel - bailleur.commandesEnCours - bailleur.quantiteAffectee;
            var part = capaciteBailleur / capaciteTotale;
            var ajout = difference * part;

            var nouvelleQuantite = bailleur.quantiteAffectee + ajout;
            var quantiteMax = bailleur.stockActuel - bailleur.commandesEnCours;

            // Ajuster sans dépasser le maximum
            bailleur.quantiteAffectee = Math.min(Math.max(0, Math.round(nouvelleQuantite)), quantiteMax);
          });

          // Ajustement final pour s'assurer que le total est exact
          var nouveauTotal = $scope.getTotalAffecte();
          var ajustementFinal = totalSouhaite - nouveauTotal;

          if (ajustementFinal !== 0) {
            // Trouver un bailleur qui peut absorber l'ajustement
            var bailleurAjustable = bailleursValides.find(function (bailleur) {
              var capacite = bailleur.stockActuel - bailleur.commandesEnCours - bailleur.quantiteAffectee;
              return Math.abs(ajustementFinal) <= capacite;
            });

            if (bailleurAjustable) {
              bailleurAjustable.quantiteAffectee += ajustementFinal;
            }
          }
        };

        // Nouvelle fonction pour gérer la sélection d'un bailleur
        $scope.onBailleurSelectionChange = function (bailleur) {
          if (bailleur.selected) {
            // Calculer la quantité disponible pour ce bailleur
            var quantiteDisponible = bailleur.stockActuel - bailleur.commandesEnCours;

            // Calculer la quantité restante à affecter
            var totalAffecte = $scope.getTotalAffecte();
            var quantiteRestante = $scope.articleSelectionne?.quantiteTotale - totalAffecte;

            // Affecter automatiquement la quantité disponible ou la quantité restante (le plus petit des deux)
            bailleur.quantiteAffectee = Math.min(quantiteDisponible, quantiteRestante);

            // Si on a encore besoin d'affecter plus, équilibrer automatiquement
            if ($scope.getTotalAffecte() < $scope.articleSelectionne?.quantiteTotale) {
              $scope.equilibrerQuantites();
            }
          } else {
            bailleur.quantiteAffectee = 0;
          }
        };




        // Watcher pour surveiller les changements de dataPage.campagnes
        $scope.$watch("dataPage['campagnes']", function (newVal, oldVal) {
          if (newVal && newVal !== oldVal) {
            $scope.initValidationData();

            // Vérifier l'état des étapes précédentes
          }
        }, true);

        // Changement d'étape avec validation


        // Passer à l'étape suivante avec validation
        // Passer à l'étape suivante avec validation
        $scope.passerEtapeSuivante = function () {
          var etapeActuelle = $scope.activeValidationStep;

          // Valider l'étape actuelle avant de passer à la suivante
          // Valider l'étape actuelle avant de passer à la suivante
          if (etapeActuelle === 4) {
            if ($scope.getOSValides().length !== $scope.osList.length) {
              alert('Veuillez valider tous les OS bailleurs avant de continuer');
              return;
            }
            $scope.etape4Validee = true;
          }

          // Valider l'étape actuelle avant de passer à la suivante
          switch (etapeActuelle) {
            case 1:
              if ($scope.commandesRecap.length === 0) {
                alert('Aucune commande client à valider');
                return;
              }
              $scope.etape1Validee = true;
              break;

            case 2:
              if ($scope.getCommandesEnAttente().length > 0) {
                alert('Veuillez valider toutes les commandes avant de continuer');
                return;
              }
              $scope.etape2Validee = true;
              break;

            case 3:
              var articlesEnAttente = $scope.getArticlesEnAttente();
              if (articlesEnAttente.length > 0) {
                alert('Veuillez affecter tous les articles aux bailleurs avant de continuer');
                return;
              }
              $scope.etape3Validee = true;
              break;

            case 4:
              if ($scope.getOSEnAttente().length > 0) {
                alert('Veuillez valider tous les OS bailleurs avant de continuer');
                return;
              }
              $scope.etape4Validee = true;
              break;

            case 5:
              if ($scope.getClientsEnAttenteLivraison().length > 0) {
                alert('Veuillez finaliser toutes les livraisons avant de terminer');
                return;
              }
              $scope.etape5Validee = true;
              break;
          }

          // Passer à l'étape suivante
          var nextStep = etapeActuelle + 1;
          if (nextStep <= 5) {
            $scope.setActiveValidationStep(nextStep);
            alert('Étape ' + etapeActuelle + ' validée avec succès! Passage à l\'étape ' + nextStep);
          } else {
            alert('Processus terminé avec succès!');
          }
        };

        // Valider toutes les commandes (étape 2)
        $scope.validerToutesCommandes = function () {
          if (confirm('Valider toutes les commandes en attente ?')) {
            $scope.commandesRecap.forEach(function (commande) {
              if (commande.statut === 'en_attente' || commande.statut === 'modifie') {
                commande.statut = 'valide';
              }
            });

            // Mettre à jour l'état de l'étape
            $scope.etape2Validee = $scope.getCommandesEnAttente().length === 0;

            alert('Toutes les commandes ont été validées avec succès!');
          }
        };

        // Initialisation des données
        $scope.initValidationData = function () {
          if ($scope.dataPage && $scope.dataPage.campagnes &&
            $scope.dataPage.campagnes[0] && $scope.dataPage.campagnes[0].commandes) {

            $scope.commandesRecap = angular.copy($scope.dataPage.campagnes[0].commandes);

            // Initialisation des statuts et quantités validées
            $scope.commandesRecap.forEach(function (commande) {
              commande.statut = commande.statut || 'en_attente';

              if (commande.detailcommandes) {
                commande.detailcommandes.forEach(function (detail) {
                  detail.quantite_validee = detail.quantite_validee || detail.quantite;
                });
              }
            });

            // Vérifier l'état des étapes
            $scope.etape1Validee = $scope.commandesRecap && $scope.commandesRecap.length > 0;


            console.log('Données de validation initialisées:', $scope.commandesRecap.length, 'commandes');
          } else {
            $scope.commandesRecap = [];
            console.warn('Aucune commande trouvée dans dataPage.campagnes[0].commandes');
          }
        };


        // ==================== FONCTIONS SPÉCIFIQUES ÉTAPE 3 ====================

        // Variables spécifiques à l'étape 3
        $scope.articleSelectionne = null;
        $scope.searchArticleSalama = '';
        $scope.bailleursList = [];

        // Initialiser les données pour l'étape 3
        $scope.initEtape3Data = function () {
          // Préparer la liste des articles avec leurs clients
          $scope.articlesList = [];

          // Regrouper les articles de toutes les commandes
          var articlesMap = {};

          $scope.commandesRecap.forEach(function (commande) {
            if (commande.detailcommandes) {
              commande.detailcommandes.forEach(function (detail) {
                if (detail.article) {
                  var articleId = detail.article.id;

                  if (!articlesMap[articleId]) {
                    articlesMap[articleId] = {
                      id: detail.article.id,
                      designation: detail.article.designation,
                      ref: detail.article.ref,
                      quantiteTotale: 0,
                      quantiteAffectee: 0,
                      pourcentageAffecte: 0,
                      nbClients: 0,
                      clients: [],
                      datecommande: commande.datecommande,
                      datereception: commande.datereception,
                      prixUnitaire: detail.prix,
                    };
                  }

                  // Simuler une date de péremption si elle est nulle
                  var datePeremption = detail.datereception;
                  if (!datePeremption) {
                    // Générer une date aléatoire entre 6 mois et 2 ans à partir de la date de commande
                    var dateCommande = new Date(commande.datecommande);
                    var minDate = new Date(dateCommande);
                    minDate.setMonth(minDate.getMonth() + 6);

                    var maxDate = new Date(dateCommande);
                    maxDate.setFullYear(maxDate.getFullYear() + 2);

                    // Générer une date aléatoire entre minDate et maxDate
                    var randomTime = minDate.getTime() + Math.random() * (maxDate.getTime() - minDate.getTime());
                    datePeremption = new Date(randomTime).toISOString().split('T')[0];
                  }

                  // Ajouter le client pour cet article
                  articlesMap[articleId].clients.push({
                    nom: commande.client ? commande.client.designation : 'N/A',
                    quantite: detail.quantite,
                    dateLivraison: commande.datecommande,
                    datePeremption: datePeremption,
                    prixUnitaire: detail.prix,
                    quantiteMin: detail.quantiteMin ?? 0,
                  });

                  articlesMap[articleId].quantiteTotale += detail.quantite;
                  articlesMap[articleId].nbClients++;
                }
              });
            }
          });

          // Convertir l'objet en array
          $scope.articlesList = Object.values(articlesMap);
          $scope.updateUniqueClients();


          // Charger la liste des bailleurs (simulée)
          $scope.bailleursList = [
            {
              id: 1,
              nom: "Bailleur A",
              lot: "LOT-001",
              stockActuel: 13500,
              commandesEnCours: 200,
              datePeremption: "2024-12-31",
              selected: false,
              quantiteAffectee: 0
            },
            {
              id: 2,
              nom: "Bailleur B",
              lot: "LOT-002",
              stockActuel: 10300,
              commandesEnCours: 150,
              datePeremption: "2024-10-15",
              selected: false,
              quantiteAffectee: 0
            },
            {
              id: 3,
              nom: "Bailleur C",
              lot: "LOT-003",
              stockActuel: 200700,
              commandesEnCours: 100,
              datePeremption: "2025-03-20",
              selected: false,
              quantiteAffectee: 0
            }
          ];

          // Sélectionner automatiquement le premier lot pour tous les articles
          $scope.articlesList.forEach(function (article) {
            if (!article.lotSelectionne) {
              article.lotSelectionne = $scope.lotsDisponibles[0].id;
            }
          });

          $scope.articlesParClient = {};
          $scope.updateArticlesParClient();

        };
        // Fonctions pour l'étape 4 modifiée
        $scope.clientsOS = [];
        // Fonction pour mettre à jour les clients OS
        $scope.updateClientsOS = function () {
          var clientsMap = {};

          // Regrouper les articles par client
          $scope.osList.forEach(function (os) {
            os.articles.forEach(function (article) {
              // Trouver le client de cet article
              var clientNom = $scope.trouverClientParArticle(article.id);

              if (!clientsMap[clientNom]) {
                clientsMap[clientNom] = {
                  nom: clientNom,
                  articles: [],
                  valide: false,
                  quantiteTotale: 0,
                  montantTotal: 0
                };
              }

              // Ajouter l'article avec les infos du bailleur
              var articleAvecClient = angular.copy(article);
              articleAvecClient.bailleurId = os.bailleur.id;
              articleAvecClient.statut = article.statut || 'en_attente';

              clientsMap[clientNom].articles.push(articleAvecClient);
            });
          });

          // Calculer les totaux et statuts
          for (var clientNom in clientsMap) {
            var client = clientsMap[clientNom];
            client.valide = client.articles.every(function (article) {
              return article.statut === 'valide';
            });
            client.quantiteTotale = client.articles.reduce(function (total, article) {
              return total + article.quantite;
            }, 0);
            client.montantTotal = client.articles.reduce(function (total, article) {
              return total + (article.quantite * article.prixUnitaire);
            }, 0);
          }

          $scope.clientsOS = Object.values(clientsMap);

          // Éviter le cycle de digest infini
          if (!$scope.$$phase) {
            $scope.$applyAsync();
          }
        };


        $scope.trouverClientParArticle = function (articleId) {
          // Utiliser une approche plus directe sans boucles imbriquées
          for (var clientNom in $scope.livraisonParClient) {
            var client = $scope.livraisonParClient[clientNom];
            for (var i = 0; i < client.articles.length; i++) {
              if (client.articles[i].id === articleId) {
                return clientNom;
              }
            }
          }
          return 'Inconnu';
        };

        $scope.getNomLot = function (bailleurId) {
          var bailleur = $scope.bailleursList.find(function (b) {
            return b.id === bailleurId;
          });
          return bailleur ? bailleur.lot : 'Inconnu';
        };

        $scope.isClientValide = function (client) {
          return client.articles.every(function (article) {
            return article.statut === 'valide';
          });
        };

        // Variables pour la gestion des OS
        $scope.articleSelectionne = null;
        $scope.clientSelectionne = null;
        $scope.dateSignature = new Date().toISOString().split('T')[0];
        $scope.fichierOS = null;
        $scope.commentaireOS = '';
        $scope.todayDate = new Date().toISOString().split('T')[0];

        // Initialiser Signature Pad
        var signaturePad = null;
        $(document).on('shown.bs.modal', '#modalSignatureOS', function () {
          var canvas = document.getElementById('signaturePad');
          signaturePad = new SignaturePad(canvas);
        });

        // Fonction pour imprimer l'OS
        // Fonction pour imprimer l'OS complet du bailleur
        $scope.imprimerOS = function (os) {
          console.log('Impression OS pour le bailleur:', os.bailleur.nom);

          // Ouvrir une nouvelle fenêtre pour l'impression
          var printWindow = window.open('', '_blank');

          // Construction du contenu HTML pour l'OS complet
          var content = `
        <html>
            <head>
                <title>OS - ${os.bailleur.nom}</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
                    .info { margin-bottom: 15px; }
                    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    .total { font-weight: bold; }
                    .footer { margin-top: 30px; border-top: 1px solid #333; padding-top: 10px; }
                    .signature-line { border-top: 1px solid #000; width: 300px; margin-top: 80px; }
                    .client-section { margin-top: 20px; padding-top: 10px; border-top: 1px dashed #ccc; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h2>ORDRE DE SERVICE</h2>
                    <h3>${os.bailleur.nom} - ${os.bailleur.lot}</h3>
                    <p>N° OS: OS-${os.bailleur.id}-${Date.now()}</p>
                </div>
                
                <div class="info">
                    <p><strong>Date d'émission:</strong> ${new Date().toLocaleDateString()}</p>
                    <p><strong>Bailleur:</strong> ${os.bailleur.nom}</p>
                    <p><strong>Lot:</strong> ${os.bailleur.lot}</p>
                    <p><strong>Quantité totale:</strong> ${os.quantiteTotale}</p>
                    <p><strong>Montant total:</strong> ${os.montantTotal}</p>
                </div>
    `;

          // Ajouter les sections pour chaque client
          os.clients.forEach(function (client, index) {
            content += `
            <div class="client-section">
                <h4>Client: ${client.nom}</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Référence</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Montant</th>
                            <th>Date Péremption</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

            // Ajouter les articles du client
            client.articles.forEach(function (article) {
              content += `
                <tr>
                    <td>${article.designation}</td>
                    <td>${article.ref}</td>
                    <td>${article.quantite}</td>
                    <td>${article.prixUnitaire}</td>
                    <td>${article.quantite * article.prixUnitaire}</td>
                    <td>${new Date(article.datePeremption).toLocaleDateString()}</td>
                </tr>
            `;
            });

            // Ajouter le total du client
            content += `
                        <tr class="total">
                            <td colspan="2">Total ${client.nom}</td>
                            <td>${client.quantiteTotale}</td>
                            <td colspan="2">${client.montantTotal}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
          });

          // Ajouter le footer avec les signatures
          content += `
                <div class="footer">
                    <div style="float: left; width: 45%;">
                        <p><strong>Responsable Bailleur:</strong></p>
                        <div class="signature-line"></div>
                        <p>Nom et signature</p>
                        <p>Date: ________________</p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </body>
        </html>
    `;

          printWindow.document.write(content);
          printWindow.document.close();
        };

        // Fonction pour signer l'OS
        $scope.signerOS = function (article) {
          $scope.articleSelectionne = article;
          $('#modalSignatureOS').modal('show');
        };
        $scope.getOSEnCours = function () {
          return $scope.osList.filter(function (os) {
            return os.statut === 'a_signee' || os.statut === 'uploadé';
          });
        };
        $scope.genererBordereauxLivraison = function () {
          if (confirm('Générer les bordereaux de livraison pour tous les OS validés ?')) {
            // Simuler la génération des BC
            console.log('Génération des bordereaux de livraison...');

            // Passer à l'étape 5
            $scope.passerEtapeSuivante();

            alert('Bordereaux de livraison générés avec succès! Passage à l\'étape 5.');
          }
        };

        // Confirmer la signature de l'OS du bailleur
        $scope.confirmerSignature = function () {
          if (!$scope.osSelectionne) {
            alert('Aucun OS sélectionné!');
            return;
          }
          if (signaturePad && !signaturePad.isEmpty()) {
            // Convertir la signature en image data URL
            var signatureData = signaturePad.toDataURL();

            // Mettre à jour le statut de l'OS
            $scope.osSelectionne.statut = 'a_signee';
            $scope.osSelectionne.dateSignature = $scope.dateSignature;
            $scope.osSelectionne.signatureData = signatureData;

            // Marquer tous les articles comme "à signer" pour cohérence
            $scope.osSelectionne.clients.forEach(function (client) {
              client.articles.forEach(function (article) {
                article.statut = 'a_signee';
              });
            });

            // Fermer le modal
            $('#modalSignatureOS').modal('hide');

            alert('OS signé avec succès! Veuillez maintenant uploader le document signé.');
          } else {
            alert('Veuillez apposer votre signature avant de confirmer.');
          }
        };

        // Fonction pour uploader l'OS signé
        $scope.uploaderOS = function (article) {
          $scope.articleSelectionne = article;
          $('#modalUploadOS').modal('show');
        };
        // Dans le contrôleur
        $scope.ouvrirModalSignature = function (os) {
          $scope.osSelectionne = os;
          $scope.dateSignature = new Date().toISOString().split('T')[0];

          $('#modalSignatureOS').modal('show');

          // Attendre que le modal soit complètement rendu pour initialiser le canvas
          setTimeout(function () {
            var canvas = document.getElementById('signaturePad');
            signaturePad = new SignaturePad(canvas);
          }, 500);
        };


        // Confirmer l'upload
        // Confirmer l'upload de l'OS du bailleur
        $scope.confirmerUpload = function () {
          var fileInput = document.getElementById('fileOS');
          if (fileInput.files.length > 0) {
            var file = fileInput.files[0];

            // Vérifier la taille du fichier (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
              alert('Le fichier est trop volumineux. Maximum 5MB autorisé.');
              return;
            }

            // Vérifier le type de fichier
            var validTypes = ['application/pdf', 'image/jpeg', 'image/png'];
            if (!validTypes.includes(file.type)) {
              alert('Format de fichier non supporté. Veuillez uploader un PDF, JPG ou PNG.');
              return;
            }

            // Simuler l'upload
            var reader = new FileReader();
            reader.onload = function (e) {
              // Mettre à jour l'OS avec les informations d'upload
              $scope.$apply(function () {
                $scope.osSelectionne.statut = 'uploadé';
                $scope.osSelectionne.fichierOS = e.target.result;
                $scope.osSelectionne.nomFichier = file.name;
                $scope.osSelectionne.dateUpload = new Date();
                $scope.osSelectionne.commentaire = $scope.commentaireOS;

                // Marquer tous les articles comme "uploadé" pour cohérence
                $scope.osSelectionne.clients.forEach(function (client) {
                  client.articles.forEach(function (article) {
                    article.statut = 'uploadé';
                  });
                });

                // Fermer le modal
                $('#modalUploadOS').modal('hide');

                alert('Document uploadé avec succès! Vous pouvez maintenant valider définitivement.');
              });
            };
            reader.readAsDataURL(file);
          } else {
            alert('Veuillez sélectionner un fichier à uploader.');
          }
        };

        // Fonction pour valider définitivement un article
        $scope.validerArticleOS = function (article) {
          if (article.statut === 'uploadé' || article.statut === 'a_signee') {
            article.statut = 'valide';
            article.dateValidation = new Date();
            alert('Article validé définitivement!');

            // Vérifier si tous les articles sont validés pour activer la génération des BC
          } else {
            alert('Veuillez d\'abord signer et uploader l\'OS avant de valider.');
          }
        };

        // Mettre à jour la fonction getStatutArticleOSText
        $scope.getStatutArticleOSText = function (statut) {
          var statuts = {
            'en_attente': 'En attente',
            'a_signee': 'À signer',
            'uploadé': 'Uploadé',
            'valide': 'Validé',
            'rejete': 'Rejeté'
          };
          return statuts[statut] || statut;
        };

        $scope.rejeterArticleOS = function (article, client) {
          article.statut = 'rejete';
          client.valide = false;
          // Les totaux restent les mêmes pour le rejet
        };

        $scope.validerTousArticlesClient = function (client) {
          client.articles.forEach(function (article) {
            article.statut = 'valide';
          });
        };

        $scope.getQuantiteTotaleClient = function (client) {
          return client.articles.reduce(function (total, article) {
            return total + article.quantite;
          }, 0);
        };
        $scope.validerTousArticlesBailleur = function (os) {
          os.clients.forEach(function (client) {
            client.articles.forEach(function (article) {
              article.statut = 'valide';
            });
          });
          os.statut = 'valide';
          $scope.etape4Validee = true;
        };

        $scope.getMontantTotalClient = function (client) {
          return client.articles.reduce(function (total, article) {
            return total + (article.quantite * article.prixUnitaire);
          }, 0);
        };

        // Fonction pour obtenir le stock d'un lot
        $scope.getStockLot = function (lotId) {
          var bailleur = $scope.bailleursList.find(function (b) {
            return b.id === lotId;
          });
          return bailleur ? bailleur.stockActuel : 0;
        };

        // Enregistrer l'affectation détaillée
        $scope.enregistrerAffectationDetail = function () {
          if ($scope.articleSelectionne && $scope.articleSelectionne.lotSelectionne) {
            // Mettre à jour l'article dans la liste principale
            $scope.articlesList.forEach(function (article) {
              if (article.id === $scope.articleSelectionne.id) {
                article.lotSelectionne = $scope.articleSelectionne.lotSelectionne;
              }
            });

            // Fermer le modal
            $('#modalAffectationDetail').modal('hide');

            // Vérifier si tous les articles sont affectés
            $scope.verifierAffectationComplete();

            alert('Affectation enregistrée avec succès!');
          }
        };

        // Fonction pour mettre à jour le mapping articles par client
        $scope.updateArticlesParClient = function () {
          $scope.articlesParClient = {};

          $scope.articlesList.forEach(function (article) {
            article.clients.forEach(function (client) {
              if (!$scope.articlesParClient[client.nom]) {
                $scope.articlesParClient[client.nom] = [];
              }

              // Créer une copie de l'article avec les infos spécifiques au client
              var articleAvecClient = angular.copy(article);
              articleAvecClient.quantite = client.quantite;
              articleAvecClient.dateLivraison = client.dateLivraison;
              articleAvecClient.datePeremption = client.datePeremption;
              articleAvecClient.prixUnitaire = client.prixUnitaire;
              articleAvecClient.quantiteMin = client.quantiteMin;
              articleAvecClient.lotSelectionne = null; // Initialiser le lot sélectionné

              $scope.articlesParClient[client.nom].push(articleAvecClient);
            });
          });
        };
        // Remplacer getArticlesByClient par:
        $scope.getArticlesByClient = function (clientNom) {
          return $scope.articlesParClient[clientNom] || [];
        };

        // Sélectionner un article
        $scope.selectArticle = function (article) {
          console.log('Article sélectionné:', article);
          $scope.articleSelectionne = article;
        };

        // Filtrer les articles
        $scope.filterArticlesSalama = function (article) {
          return !$scope.searchArticleSalama ||
            (article.designation && article.designation.toLowerCase().includes($scope.searchArticleSalama.toLowerCase())) ||
            (article.ref && article.ref.toLowerCase().includes($scope.searchArticleSalama.toLowerCase()));
        };

        // Ouvrir le modal d'affectation
        $scope.openAffectationBailleur = function () {
          if ($scope.articleSelectionne) {
            // Réinitialiser les sélections des bailleurs
            $scope.bailleursList.forEach(function (bailleur) {
              bailleur.selected = false;
              bailleur.quantiteAffectee = 0;
            });

            // Ouvrir le modal
            $('#modalAffectationBailleur').modal('show');
          }
        };

        // Mettre à jour la quantité d'affectation
        $scope.updateQuantiteAffectation = function (bailleur) {
          if (!bailleur.selected) {
            bailleur.quantiteAffectee = 0;
          }
        };

        // Calculer la quantité maximale pouvant être affectée
        $scope.calculerMaxQuantite = function (bailleur) {
          return Math.min(bailleur.stockActuel - bailleur.commandesEnCours,
            $scope.articleSelectionne?.quantiteTotale - $scope.getTotalAffecte() + bailleur.quantiteAffectee);
        };

        // Obtenir le total affecté
        $scope.getTotalAffecte = function () {
          return $scope.bailleursList.reduce(function (total, bailleur) {
            return total + (bailleur.quantiteAffectee || 0);
          }, 0);
        };

        // Vérifier si la quantité affectée à un bailleur est valide
        $scope.isQuantiteValide = function (bailleur) {
          if (!bailleur.selected || !bailleur.quantiteAffectee || bailleur.quantiteAffectee <= 0) {
            return true; // Non sélectionné ou quantité nulle = valide
          }

          var quantiteDisponible = bailleur.stockActuel - bailleur.commandesEnCours;
          return bailleur.quantiteAffectee <= quantiteDisponible;
        };

        // Vérifier une quantité spécifique
        $scope.verifierQuantite = function (bailleur) {
          if (bailleur.selected && bailleur.quantiteAffectee > 0) {
            var quantiteDisponible = bailleur.stockActuel - bailleur.commandesEnCours;

            if (bailleur.quantiteAffectee > quantiteDisponible) {
              console.warn('Quantité excessive pour', bailleur.nom, '- Max:', quantiteDisponible);
            }
          }
        };

        // Vérifier s'il y a des quantités invalides
        $scope.hasQuantitesInvalides = function () {
          return $scope.bailleursList.some(function (bailleur) {
            return bailleur.selected && bailleur.quantiteAffectee > 0 && !$scope.isQuantiteValide(bailleur);
          });
        };
        // Modifier une commande
        $scope.modifierCommande = function (commande) {
          commande.statut = 'modifie';
          console.log('Commande modifiée:', commande.id);
        };
        // Appliquer la même quantité à tous les articles
        $scope.appliquerMemeQuantite = function () {
          if ($scope.commandeSelectionnee && $scope.commandeSelectionnee.detailcommandes.length > 0) {
            var quantite = parseInt(prompt('Quelle quantité appliquer à tous les articles?', $scope.commandeSelectionnee.detailcommandes[0].quantite_validee));

            if (!isNaN(quantite)) {
              $scope.commandeSelectionnee.detailcommandes.forEach(function (detail) {
                detail.quantite_validee = Math.min(quantite, detail.quantite);
              });
              $scope.updateStatutCommande($scope.commandeSelectionnee);
            }
          }
        };
        // Vérifier si l'affectation globale est valide
        $scope.isAffectationValide = function () {
          var totalAffecte = $scope.getTotalAffecte();
          var hasInvalidQuantities = $scope.hasQuantitesInvalides();

          return totalAffecte === $scope.articleSelectionne?.quantiteTotale && !hasInvalidQuantities;
        };
        $scope.selectCommande = function (commande) {
          if (!commande || !commande.detailcommandes) {
            console.error("Commande invalide ou sans détails");
            return;
          }

          $scope.commandeSelectionnee = commande;

          // Initialiser les quantités validées si elles n'existent pas
          commande.detailcommandes.forEach(function (detail) {
            if (typeof detail.quantite_validee === 'undefined') {
              detail.quantite_validee = detail.quantite || 0;
            }
          });
        };
        // Fonction pour mettre à jour la quantité d'un détail - CORRIGÉ
        $scope.updateDetailQuantite = function (detail) {
          if (!detail) return;

          // Validation de la quantité
          if (detail.quantite_validee < 0) {
            detail.quantite_validee = 0;
          }

          if (detail.quantite_validee > (detail.quantite || 0)) {
            detail.quantite_validee = detail.quantite || 0;
          }

          // Mettre à jour le statut de la commande
          if ($scope.commandeSelectionnee) {
            $scope.updateStatutCommande($scope.commandeSelectionnee);
          }
        };

        // Fonction pour calculer le pourcentage de validation - CORRIGÉ
        $scope.getPourcentageValide = function (commande) {
          if (!commande || !commande.detailcommandes || !commande.detailcommandes.length) return 0;

          let totalQuantite = 0;
          let totalValidee = 0;

          commande.detailcommandes.forEach(function (detail) {
            totalQuantite += detail.quantite || 0;
            totalValidee += detail.quantite_validee || 0;
          });

          if (totalQuantite === 0) return 0;

          return Math.round((totalValidee / totalQuantite) * 100);
        };



        // Équilibrer automatiquement les quantités
        $scope.equilibrerQuantites = function () {
          var totalActuel = $scope.getTotalAffecte();
          var totalSouhaite = $scope.articleSelectionne?.quantiteTotale;
          var difference = totalSouhaite - totalActuel;

          if (difference === 0) return;

          // Trouver les bailleurs sélectionnés valides
          var bailleursValides = $scope.bailleursList.filter(function (bailleur) {
            return bailleur.selected && $scope.isQuantiteValide(bailleur);
          });

          if (bailleursValides.length === 0) return;

          // Répartir la différence proportionnellement
          var repartition = difference / bailleursValides.length;

          bailleursValides.forEach(function (bailleur) {
            var nouvelleQuantite = bailleur.quantiteAffectee + repartition;
            var quantiteMax = bailleur.stockActuel - bailleur.commandesEnCours;

            // Ajuster sans dépasser le maximum
            bailleur.quantiteAffectee = Math.min(Math.max(0, nouvelleQuantite), quantiteMax);
          });

          // Si l'équilibrage n'est pas parfait, rappeler récursivement
          var nouveauTotal = $scope.getTotalAffecte();
          if (Math.abs(nouveauTotal - totalSouhaite) > 0.1) {
            $scope.equilibrerQuantites();
          }
        };

        // Modifier la fonction d'enregistrement pour mettre à jour correctement l'article
        $scope.enregistrerAffectation = function () {
          if (!$scope.isAffectationValide()) {
            alert('Veuillez corriger les erreurs avant d\'enregistrer.');
            return;
          }

          var affectation = {
            article: $scope.articleSelectionne,
            bailleurs: $scope.bailleursList.filter(function (b) { return b.selected && b.quantiteAffectee > 0; }),
            totalAffecte: $scope.getTotalAffecte(),
            date: new Date()
          };

          console.log('Affectation enregistrée:', affectation);

          // Mettre à jour l'article dans la liste
          var articleIndex = $scope.articlesList.findIndex(function (a) {
            return a.id === $scope.articleSelectionne.id;
          });

          if (articleIndex !== -1) {
            $scope.articlesList[articleIndex].quantiteAffectee = affectation.totalAffecte;
            $scope.articlesList[articleIndex].pourcentageAffecte = Math.round((affectation.totalAffecte / $scope.articlesList[articleIndex].quantiteTotale) * 100);

            // Mettre à jour également l'article sélectionné
            $scope.articleSelectionne.quantiteAffectee = affectation.totalAffecte;
            $scope.articleSelectionne.pourcentageAffecte = Math.round((affectation.totalAffecte / $scope.articleSelectionne?.quantiteTotale) * 100);
          }

          // Fermer le modal
          $('#modalAffectationBailleur').modal('hide');

          // Vérifier si tous les articles sont affectés
          var tousAffectes = $scope.articlesList.every(function (article) {
            return article.quantiteAffectee === article.quantiteTotale;
          });

          if (tousAffectes) {
            $scope.etape3Validee = true;
            alert('Tous les articles ont été affectés avec succès!');
          } else {
            alert('Affectation enregistrée avec succès!');
          }
        };
        // Valider une commande - VERSION CORRIGÉE
        $scope.validerCommande = function (commande) {
          if (!commande) return;

          if (confirm('Voulez-vous vraiment valider cette commande ?')) {
            commande.statut = 'valide';
            commande.detailcommandes.forEach(function (detail) {
              detail.quantite_validee = detail.quantite || 0;
            });

            // Vérifier si toutes les commandes sont validées
            $scope.verifierEtape2Validee();

            alert('Commande validée avec succès!');
          }
        };
        // Fonction pour vérifier si l'étape 2 est validée - CORRIGÉ
        $scope.verifierEtape2Validee = function () {
          if (!$scope.commandesRecap || !$scope.commandesRecap.length) {
            $scope.etape2Validee = false;
            return;
          }

          const commandesEnAttente = $scope.commandesRecap.filter(function (c) {
            return c.statut === 'en_attente' || c.statut === 'modifie';
          });

          $scope.etape2Validee = commandesEnAttente.length === 0;
        };

        // ==================== FONCTIONS D'INITIALISATION SUPPLÉMENTAIRES ====================


        // Appeler l'initialisation une première fois
        $scope.initValidationData();
      }



      $scope.toggleDetails = function (blId) {
        $scope.dataPage['bls'].forEach(function (bl) {
          if (bl.id === blId) {
            bl.showDetails = !bl.showDetails;
          } else {
            bl.showDetails = false; // Ferme les autres détails
          }
        });
      };

      if ($scope.currentTemplateUrl.indexOf("list-detailprogramme") !== -1) {
        let clients = [];

        // Observer les changements sur dataPage['clients']
        $scope.$watch("dataPage['clients']", function (newVal) {
          if (newVal && newVal.length > 0) {
            clients = newVal;

            // Si programmes est déjà disponible, affecter les clients immédiatement
            if ($scope.dataPage['programmes'] && $scope.dataPage['programmes'].length > 0) {
              $scope.dataPage.programmes[0].clients = clients;
            }
            console.log($scope.dataPage.programmes[0]);
          }
        });

        // Observer les changements sur dataPage['programmes']
        $scope.$watch("dataPage['programmes']", function (newVal) {
          if (newVal && newVal.length > 0) {
            // Affecter les clients si disponibles
            if (clients.length > 0) {
              $scope.dataPage.programmes[0].clients = clients;
            }
          }
        });
      }



      $(".select_2").on("change", function (e) {
        const selectedValue = e.target.value;
        const type = $scope.currentTemplateUrl.split("-")[1];
        $scope.paginations[type].entryLimit =
          parseInt(selectedValue) ?? ENTRYLIMIT;
        if (type && typeof type === "string") $scope.pageChanged(type);
      });
    });
    $scope.openPhaseIndex = 0; // Phase ouverte par défaut
    $scope.enregistrerModifications = function () {
      if (!$scope.commande.motifModification || $scope.commande.motifModification.trim() === '') {
        alert("Veuillez indiquer un motif pour la modification.");
        return;
      }

      console.log("Modifications enregistrées :", $scope.commande.articles);
      console.log("Motif :", $scope.commande.motifModification);

      // Tu peux ajouter ici un appel backend ou un enregistrement local
      alert("Modifications enregistrées temporairement !");
    };


    $scope.showcommande = function (categorie) {
      console.log('cat: ' + categorie);
      if (categorie == 0) {
        $scope.dataPage.commandestatics = $scope.dataPage.commandestaticstempon;
      } else {
        console.log($scope.dataPage.commandestaticstempon.find(c => c.cat === parseInt(categorie)))
        $scope.dataPage.commandestatics = $scope.dataPage.commandestaticstempon.find(c => c.cat === parseInt(categorie));
      }

    }

    // Fonction pour calculer le montant total de la commande
    $scope.getMontantTotal = function () {
      let total = 0;
      if ($scope.supplier && $scope.supplier.dossierfournisseur && $scope.supplier.dossierfournisseur.soumissions) {
        $scope.supplier.dossierfournisseur.soumissions.forEach(function (soumission) {
          const article = $scope.getArticleById(soumission.articleId);
          if (article) {
            total += article.prixUnitaire * article.quantite;
          }
        });
      }
      return total;
    };

    // Fonction pour calculer le montant de l'acompte (30% du total)
    // $scope.getMontantAcompte = function () {
    //   return $scope.getMontantTotal() * 0.3;
    // };


    // Fonctions utilitaires
    $scope.getTypeLabel = function (type) {
      const types = {
        'AON': 'Appel d\'Offre National',
        'AOI': 'Appel d\'Offre International',
        'AOR': 'Appel d\'Offre Restreint',
        'CONSULTATION': 'Consultation/Cotation',
        'DIRECT': 'Achat Direct',
        'LTA': 'Accord-cadre (LTA)'
      };
      return types[type] || type;
    };
    $scope.dataPage = {

      permissions: [],
      roles: [],
      users: [],
      clients: [],
      oeuvres: [
        {
          id: 1,
          designation: "Oba_Ozolua",
          titre_fr: "Plaque de bronze Oba Ozolua",
          titre_en: "Bronze plaque of Oba Ozolua",
          titre_wo: "Tàbal bróns Oba Ozolua",
          description_fr: "Plaque de bronze représentant Oba Ozolua se préparant à la guerre. Œuvre emblématique du royaume du Bénin montrant le souverain en tenue de combat.",
          description_en: "Bronze plaque depicting Oba Ozolua preparing for war. Iconic artwork from the Benin Kingdom showing the ruler in battle attire.",
          description_wo: "Tàbal bróns biñu Oba Ozolua di sàkku xéew. Xaaj bu am solo ci nguurug Bénin bi.",
          artiste: "Artiste anonyme du royaume du Bénin",
          date_creation: "XVIe siècle",
          origine: "Royaume du Bénin, Nigeria",
          materiaux: "Bronze, alliage cuivreux",
          dimensions: "30cm x 25cm",
          image_url: "images/musee/Oba_Ozolua_-_MCN_4185.jpg",
          audio_fr_url: "/audio/oba_ozolua_fr.mp3",
          audio_en_url: "/audio/oba_ozolua_en.mp3",
          audio_wo_url: "/audio/oba_ozolua_wo.mp3",
          video_url: "/video/oba_ozolua.mp4",
          qr_code: "MCN-OZOLUA-001",
          localisation_salle: "Salle 1A - Art Royal"
        },
        {
          id: 2,
          designation: "Oba_Oguola",
          titre_fr: "Portrait d'Oba Oguola",
          titre_en: "Portrait of Oba Oguola",
          titre_wo: "Portre Oba Oguola",
          description_fr: "Représentation sculpturale d'Oba Oguola, souverain du royaume du Bénin. L'œuvre illustre la maîtrise de la technique de la cire perdue.",
          description_en: "Sculptural representation of Oba Oguola, ruler of the Benin Kingdom. The artwork demonstrates mastery of the lost-wax casting technique.",
          description_wo: "Melokaan Oba Oguola, buur bi ci nguurug Bénin bi. Xaaj bi wone xam-xamu jëfandeku waxi weex.",
          artiste: "Maître fondeur du Bénin",
          date_creation: "XVe siècle",
          origine: "Royaume du Bénin, Nigeria",
          materiaux: "Laiton, alliage métallique",
          dimensions: "45cm x 35cm",
          image_url: "images/musee/Oba_Oguola_-_MCN_4179_(cropped2).jpg",
          audio_fr_url: "/audio/oba_oguala_fr.mp3",
          audio_en_url: "/audio/oba_oguala_en.mp3",
          audio_wo_url: "/audio/oba_oguala_wo.mp3",
          video_url: "/video/oba_oguala.mp4",
          qr_code: "MCN-OGUOLA-002",
          localisation_salle: "Salle 1A - Art Royal"
        },
        {
          id: 3,
          designation: "Armure_du_chasseur",
          titre_fr: "Armure du chasseur Dogon",
          titre_en: "Dogon Hunter's Armor",
          titre_wo: "Wàllu njëkkatu Dogon",
          description_fr: "Tenue rituelle du chasseur Dogon portée comme armure spirituelle pour se protéger des esprits maléfiques lors des expéditions de chasse.",
          description_en: "Ritual attire of the Dogon hunter worn as spiritual armor to protect against evil spirits during hunting expeditions.",
          description_wo: "Yéegu njëkkatu Dogon di wàllu xel, ngir ànd ak mbooloo yu bon ci xarey njëkk.",
          artiste: "Artisan Dogon anonyme",
          date_creation: "XIXe siècle",
          origine: "Pays Dogon, Mali",
          materiaux: "Cuir, cauris, perles, métal, amulettes",
          dimensions: "180cm x 60cm",
          image_url: "images/musee/Armure_du_chasseur_Dogon.jpg",
          audio_fr_url: "/audio/armure_chasseur_fr.mp3",
          audio_en_url: "/audio/armure_chasseur_en.mp3",
          audio_wo_url: "/audio/armure_chasseur_wo.mp3",
          video_url: "/video/armure_chasseur.mp4",
          qr_code: "MCN-ARMURE-003",
          localisation_salle: "Salle 2B - Spiritualité"
        },
        {
          id: 4,
          designation: "deesse",
          titre_fr: "Statue de la déesse Sekhmet",
          titre_en: "Statue of Goddess Sekhmet",
          titre_wo: "Santuram yàlla ju góor Sekhmet",
          description_fr: "Représentation granodiorite de Sekhmet, déesse lionne de la guerre et de la guérison dans la mythologie égyptienne antique.",
          description_en: "Granodiorite representation of Sekhmet, lioness goddess of war and healing in ancient Egyptian mythology.",
          description_wo: "Melokaan granodiorite Sekhmet, yàlla ju góor ju xare ak faj ci léebi Misra yaatu.",
          artiste: "Sculpteur égyptien anonyme",
          date_creation: "XIVe siècle avant JC",
          origine: "Égypte ancienne",
          materiaux: "Granodiorite",
          dimensions: "215cm x 100cm x 56cm",
          image_url: "images/musee/deesse.png",
          audio_fr_url: "/audio/deesse_sekhmet_fr.mp3",
          audio_en_url: "/audio/deesse_sekhmet_en.mp3",
          audio_wo_url: "/audio/deesse_sekhmet_wo.mp3",
          video_url: "/video/deesse_sekhmet.mp4",
          qr_code: "MCN-SEKMET-004",
          localisation_salle: "Salle 3C - Civilisations Anciennes"
        },
        {
          id: 5,
          designation: "Œuvre de démonstration",
          titre_fr: "Œuvre de démonstration",
          titre_en: "Demonstration Artwork",
          titre_wo: "Xaaj wone",
          description_fr: "Œuvre de test pour la démonstration des fonctionnalités de l'application musée.",
          description_en: "Test artwork for demonstrating museum application features.",
          description_wo: "Xaaj wone jëfandeku app musée bi.",
          artiste: "Artiste contemporain",
          date_creation: "2024",
          origine: "Sénégal",
          materiaux: "Mixed media",
          dimensions: "50cm x 50cm",
          image_url: "images/musee/R.jpeg",
          audio_fr_url: "/audio/test_fr.mp3",
          audio_en_url: "/audio/test_en.mp3",
          audio_wo_url: "/audio/test_wo.mp3",
          video_url: "/video/test.mp4",
          qr_code: "MCN-TEST-005",
          localisation_salle: "Salle 4D - Art Contemporain"
        }
      ],
      collections: [
        {
          id: 1,
          designation: "COLLECTION DU MCN",
          conservateur: "Dr. Amadou Diallo",
          date_creation: "2020-01-15",
          statut: "publique",
          created_at: "2024-01-01 10:00:00",
          description: "Collection d'œuvres représentant la royauté et le pouvoir en Afrique",
          image_url: "images/musee/collection.jpg",
          qr_code: "MCN-COLLECTION-001",
          localisation_salle: "Salle 1A - Royaute et pouvoir",
          nbre_oeuvres: 2,
        }
      ],
      collectionoeuvres: [
        {
          id: 1,
          collection_id: 1,
          oeuvre_id: 1,
          date_ajout: "2024-01-01",
          ordre_d_exposition: 1,
          created_at: "2024-01-01 10:30:00"
        },
        {
          id: 2,
          collection_id: 1,
          oeuvre_id: 2,
          date_ajout: "2024-01-01",
          ordre_d_exposition: 2,
          created_at: "2024-01-01 11:00:00"
        }
      ],
      horaires: [
        {
          id: 1,
          jour_semaine: "lundi",
          heure_ouverture: "09:00",
          heure_fermeture: "18:00",
          exceptions: [],
          created_at: "2024-01-01 10:00:00"
        },
        {
          id: 2,
          jour_semaine: "mardi",
          heure_ouverture: "09:00",
          heure_fermeture: "18:00",
          exceptions: [],
          created_at: "2024-01-01 10:00:00"
        },
        {
          id: 3,
          jour_semaine: "mercredi",
          heure_ouverture: "09:00",
          heure_fermeture: "21:00", // Nocturne
          exceptions: [],
          created_at: "2024-01-01 10:00:00"
        },
        {
          id: 4,
          jour_semaine: "jeudi",
          heure_ouverture: "09:00",
          heure_fermeture: "18:00",
          exceptions: [],
          created_at: "2024-01-01 10:00:00"
        }
      ],
      billets: [
        {
          id: 1,
          utilisateur_id: 1,
          user_name: "Mansour POUYE",
          type_tarif_id: 1,
          code_qr: "MCN-BILLET-001",
          date_achat: "2024-01-15",
          date_validite: "2024-01-15",
          statut: "actif",
          prix_paye: 5000,
          created_at: "2024-01-15 14:30:00"
        },
        {
          id: 2,
          utilisateur_id: 2,
          user_name: "Babacar  POUYE",
          type_tarif_id: 2,
          code_qr: "MCN-BILLET-002",
          date_achat: "2024-01-16",
          date_validite: "2024-01-16",
          statut: "utilise",
          prix_paye: 2500,
          created_at: "2024-01-16 10:15:00"
        },
        {
          id: 3,
          utilisateur_id: 3,
          user_name: "Basse  SARR",
          type_tarif_id: 3,
          code_qr: "MCN-BILLET-003",
          date_achat: "2024-01-17",
          date_validite: "2024-01-17",
          statut: "actif",
          prix_paye: 3000,
          created_at: "2024-01-17 11:20:00"
        }
      ],
      tarifs: [
        {
          id: 1,
          type_billet: "Adulte",
          prix: 5000,
          categorie: "adulte",
          conditions: "À partir de 18 ans",
          created_at: "2024-01-01 10:00:00"
        },
        {
          id: 2,
          type_billet: "Enfant",
          prix: 2500,
          categorie: "enfant",
          conditions: "De 6 à 17 ans",
          created_at: "2024-01-01 10:00:00"
        },
        {
          id: 3,
          type_billet: "Étudiant",
          prix: 3000,
          categorie: "etudiant",
          conditions: "Sur présentation de la carte étudiant",
          created_at: "2024-01-01 10:00:00"
        },
        {
          id: 5,
          type_billet: "Groupe",
          prix: 3500,
          categorie: "groupe",
          conditions: "Minimum 10 personnes",
          created_at: "2024-01-01 10:00:00"
        }
      ],
      parcours: [
        {
          id: 1,
          titre: "Civilisations Ouest-Africaines",
          description: "Parcours éducatif sur les empires africains",

          // ŒUVRES DU PARCOURS
          oeuvres: [1, 2, 3, 4, 5], // IDs des œuvres

          // QUIZ D'ÉVALUATION
          quiz: 5, // ID du quiz

          // ACCÈS ÉLÈVES
          qr_code: "EDU-MCN-5A2B8C",
          url: "https://mcn.edu/visite/5A2B8C",

          // DATES
          date_creation: "2024-01-15",
          date_expiration: "2024-12-31"
        },
        {

          id: 2,
          titre: "Symboles du Pouvoir Royal",
          description: "Découverte des insignes royaux",

          oeuvres: [1, 2, 5],
          quiz: 6,
          qr_code: "EDU-ROYAL-9F3E7D",
          url: "https://mcn.edu/royal/9F3E7D",
          date_creation: "2024-02-01",
          date_expiration: "2024-06-30"
        },

      ],
      evenements: [
        {
          id: 1,
          titre: "Journées Culturelles Panafricaines - 1ère Édition",
          description: "Week-end culturel au Musée des Civilisations noires avec activités diverses et visite de parlementaires de la sous-région",
          type_evenement: "festival",
          date_debut: "2024-06-15 10:00:00",
          date_fin: "2024-06-16 20:00:00",
          image_url: "/images/evenements/journees_panafricaines.jpg",
          prix_supplement: 0,
          places_disponibles: 500,
          reservations_requises: false,
          statut: "termine"
        },
        {
          id: 2,
          titre: "Panafricanism and Palestine",
          description: "Conversation exceptionnelle avec Momodou Taal et Tabara Korka Ndiaye sur l'unité africaine et l'émancipation du peuple palestinien",
          type_evenement: "conference",
          date_debut: "2024-06-22 15:00:00",
          date_fin: "2024-06-22 17:00:00",
          image_url: "/images/evenements/panafricanisme_palestine.jpg",
          prix_supplement: 0,
          places_disponibles: 200,
          reservations_requises: false,
          statut: "actif",
          diffusion_live: true,
          plateformes_live: ["Facebook", "YouTube"]
        }, {
          id: 3,
          titre: "Congrès Association of Black Anthropologists",
          description: "Premier congrès en Afrique de l'ABA avec près de 200 participants internationaux sur le thème 'L'anthropologie et l'expérience noire'",
          type_evenement: "congres",
          date_debut: "2024-05-20 09:00:00",
          date_fin: "2024-05-22 18:00:00",
          image_url: "/images/evenements/congres_anthropologie.jpg",
          prix_supplement: 15000,
          places_disponibles: 200,
          reservations_requises: true,
          statut: "termine",
          partenaires: ["Society of Black Archaeologists", "URICA-IFAN", "BIBA"]
        },
        {
          id: 4,
          titre: "Ciné-débat Omar Blondin Diop - 52ème Anniversaire",
          description: "Projection du film 'Juste un Mouvement' et débat sur l'art comme outil révolutionnaire avec la famille et des experts",
          type_evenement: "cine_debat",
          date_debut: "2024-05-11 18:00:00",
          date_fin: "2024-05-11 22:00:00",
          image_url: "/images/evenements/cine_debat_omar.jpg",
          prix_supplement: 0,
          places_disponibles: 150,
          reservations_requises: true,
          statut: "termine",
          film: "Juste un Mouvement de Vincent Meessen",
          intervenants: ["Bécaye Blondin Diop", "Florian Bobin", "Rama Thiaw", "Joe Cabral"]
        }, {
          id: 5,
          titre: "Projection du Film FANON",
          description: "Projection suivie d'un débat avec Souleymane Gueye, Claudia Mosquera, Dialo Diop et autres experts",
          type_evenement: "projection",
          date_debut: "2025-05-03 10:30:00",
          date_fin: "2025-05-03 13:00:00",
          image_url: "/images/evenements/film_fanon.jpg",
          prix_supplement: 0,
          places_disponibles: 120,
          reservations_requises: true,
          statut: "a_venir",
          lieu: "Auditorium du Musée des Civilisations noires",
          intervenants: ["Souleymane Gueye", "Claudia Mosquera", "Dialo Diop", "Ferdulius Zita Odome Angone", "Ismahan Soukeyna Diop"]
        }
      ],
      expositions: [
        {
          id: 1,
          titre: "L'Afrique : Berceau de l'Humanité",
          description: "Exposition sur les découvertes fossiles de Toumaï et Dinknesh...",
          date_debut: "2024-01-15",
          date_fin: "2024-12-31",
          collection_id: 1,
          salle: "Salle 1 - Origines",
          commissaire: "Dr. Amadou Diallo",
          image_url: "/images/expositions/berceau_humanite.jpg",
          statut: "active"
        },
        {
          id: 2,
          titre: "Contributions de l'Afrique à la Science et à la Technologie",
          description: "Parcours historique des inventions africaines...",
          date_debut: "2024-02-01",
          date_fin: "2024-11-30",
          collection_id: 2,
          salle: "Salle 2 - Sciences",
          commissaire: "Pr. Fatou Ndiaye",
          image_url: "/images/expositions/science_technologie.jpg",
          statut: "active"
        },
        {
          id: 3,
          titre: "L'Histoire de la Métallurgie en Afrique",
          description: "Exposition sur les techniques métallurgiques africaines...",
          date_debut: "2024-03-10",
          date_fin: "2024-10-15",
          collection_id: 3,
          salle: "Salle 3 - Métallurgie",
          commissaire: "Dr. Ibrahima Sarr",
          image_url: "/images/expositions/metallurgie.jpg",
          statut: "active"
        },
        {
          id: 4,
          titre: "Lignes de Continuité : L'Art de la Figure",
          description: "Exposition d'œuvres d'artistes inspirés par la forme humaine...",
          date_debut: "2024-04-05",
          date_fin: "2024-09-20",
          collection_id: 4,
          salle: "Salle 4 - Art Contemporain",
          commissaire: "M. Jean Koffi",
          image_url: "/images/expositions/art_figure.jpg",
          statut: "active"
        }
      ],
      activites: [
        {
          id: 1,
          titre: "Atelier de Poterie Traditionnelle",
          description: "Initiation aux techniques ancestrales de poterie africaine...",
          type_activite: "atelier",
          duree: "2 heures",
          public_cible: "Adultes et adolescents",
          capacite_max: 15,
          animateur: "Mamadou Sarr, artisan potier",
          prix: 5000,
          materiel_fourni: true,
          date_activite: "2024-02-15 14:00:00",
          statut: "active"
        },
        {
          id: 2,
          titre: "Visite Guidée : Symboles du Pouvoir",
          description: "Visite commentée sur les symboles de pouvoir...",
          type_activite: "visite_guidee",
          duree: "1 heure 30",
          public_cible: "Tous publics",
          capacite_max: 25,
          animateur: "Dr. Aminata Diallo, historienne de l'art",
          prix: 2000,
          materiel_fourni: false,
          date_activite: "2024-02-20 10:30:00",
          statut: "active"
        },
        {
          id: 3,
          titre: "Contes et Légendes d'Afrique",
          description: "Atelier de contes traditionnels pour enfants...",
          type_activite: "atelier_enfant",
          duree: "1 heure",
          public_cible: "Enfants 6-12 ans",
          capacite_max: 20,
          animateur: "Mariama Sow, conteuse",
          prix: 1000,
          materiel_fourni: true,
          date_activite: "2024-02-25 15:00:00",
          statut: "active"
        },
        {
          id: 4,
          titre: "Démonstration de Danses Traditionnelles",
          description: "Spectacle et initiation aux danses traditionnelles...",
          type_activite: "spectacle",
          duree: "2 heures",
          public_cible: "Tous publics",
          capacite_max: 50,
          animateur: "Compagnie de Danse Sabar",
          prix: 3000,
          materiel_fourni: false,
          date_activite: "2024-03-05 18:00:00",
          statut: "active"
        }
      ],
      ateliers: [
        {
          id: 1,
          titre: "Initiation à la Sculpture sur Bois",
          description: "Atelier pratique pour apprendre les techniques de base...",
          createur_id: 5,
          animateur: "Moussa Diop, sculpteur traditionnel",
          date_atelier: "2024-03-10 14:00:00",
          duree: "3 heures",
          prix: 8000,
          places_max: 12,
          niveau: "débutant",
          materiel_fourni: "ciseaux à bois, maillet, bois",
          oeuvres_ids: [1, 3],
          quiz_id: 8,
          statut: "actif"
        },
        {
          id: 2,
          titre: "Techniques de Fonte à la Cire Perdue",
          description: "Découverte des méthodes traditionnelles de fonte du bronze...",
          createur_id: 8,
          animateur: "Dr. Fatou Bâ, métallurgiste",
          date_atelier: "2024-03-15 10:00:00",
          duree: "4 heures",
          prix: 12000,
          places_max: 8,
          niveau: "intermédiaire",
          materiel_fourni: "cire, argile, four de fusion",
          oeuvres_ids: [1, 2],
          quiz_id: 9,
          statut: "actif"
        },
        {
          id: 3,
          titre: "Déchiffrer les Symboles dans l'Art Africain",
          description: "Atelier théorique pour comprendre la signification des symboles...",
          createur_id: 12,
          animateur: "Pr. Jean Ndoye, sémiologue",
          date_atelier: "2024-03-20 16:00:00",
          duree: "2 heures",
          prix: 5000,
          places_max: 20,
          niveau: "tous niveaux",
          materiel_fourni: "documents, fiches pédagogiques",
          oeuvres_ids: [1, 2, 3, 4],
          quiz_id: 10,
          statut: "actif"
        },
        {
          id: 4,
          titre: "Création de Bogolan et Tissages",
          description: "Atelier pratique sur les techniques de teinture naturelle...",
          createur_id: 6,
          animateur: "Aminata Sow, artisane textile",
          date_atelier: "2024-03-25 13:00:00",
          duree: "3 heures 30",
          prix: 7000,
          places_max: 15,
          niveau: "débutant",
          materiel_fourni: "tissus, pigments naturels, métier à tisser",
          oeuvres_ids: [5],
          quiz_id: 11,
          statut: "a_venir"
        }
      ],
      quizs: [
        {
          id: 1,
          titre: "Quiz Art Royal Africain",
          description: "Testez vos connaissances sur l'art royal des civilisations africaines",
          questions: [
            {
              id: 1,
              question: "Quelle civilisation est célèbre pour ses plaques de bronze représentant les Oba?",
              type: "choix_multiple",
              reponses: ["Empire du Mali", "Royaume du Bénin", "Royaume Kongo", "Empire Songhaï"],
              bonne_reponse: 1,
              points: 10,
              explication: "Le Royaume du Bénin est réputé pour ses plaques de bronze."
            }
          ],
          duree_limite: 15,
          score_max: 18,
          difficulte: "facile"
        },
        {
          id: 2,
          titre: "Symbolisme et Spiritualité",
          description: "Questions sur les croyances et symboles dans l'art traditionnel africain",
          questions: [
            {
              id: 1,
              question: "Quel peuple utilise des masques Dogon lors des cérémonies d'initiation?",
              type: "choix_multiple",
              reponses: ["Peuple Dogon du Mali", "Yoruba du Nigeria", "Ashanti du Ghana", "Zoulou d'Afrique du Sud"],
              bonne_reponse: 0,
              points: 10,
              explication: "Les Dogon utilisent des masques complexes dans leurs rituels."
            }
          ],
          duree_limite: 10,
          score_max: 10,
          difficulte: "moyen"
        },
        {
          id: 3,
          titre: "Techniques Artistiques Traditionnelles",
          description: "Quiz sur les méthodes de création dans l'art africain traditionnel",
          questions: [
            {
              id: 1,
              question: "Quelle technique de fonte était utilisée pour les bronzes du Bénin?",
              type: "choix_multiple",
              reponses: ["Fonte au sable", "Cire perdue", "Moulage en plâtre", "Coulée continue"],
              bonne_reponse: 1,
              points: 12,
              explication: "La technique de la cire perdue permettait des pièces très détaillées."
            }
          ],
          duree_limite: 20,
          score_max: 20,
          difficulte: "intermediaire"
        },
        {
          id: 4,
          titre: "Grandes Civilisations Africaines",
          description: "Test sur les empires et royaumes historiques d'Afrique",
          questions: [
            {
              id: 1,
              question: "Quel empire ouest-africain était réputé pour ses mines d'or?",
              type: "choix_multiple",
              reponses: ["Empire du Ghana", "Royaume d'Aksoum", "Empire du Mali", "Royaume du Zimbabwe"],
              bonne_reponse: 2,
              points: 10,
              explication: "L'Empire du Mali était célèbre pour sa richesse en or."
            }
          ],
          duree_limite: 12,
          score_max: 10,
          difficulte: "facile"
        }
      ],
      produits: [
        {
          id: 1,
          nom: "L'Art Royal Africain : Symboles et Pouvoir",
          description: "Livre illustré sur les symboles du pouvoir...",
          prix: 15000,
          categorie_id: 1,
          image_url: "/images/boutique/livre_art_royal.jpg",
          stock: 50,
          statut: "disponible",
          oeuvre_associee: 1,
          type_produit: "livre"
        },
        {
          id: 2,
          nom: "Réplique Plaque Oba Ozolua",
          description: "Réplique fidèle de la plaque de bronze Oba Ozolua...",
          prix: 25000,
          categorie_id: 2,
          image_url: "/images/boutique/replique_ozolua.jpg",
          stock: 15,
          statut: "disponible",
          oeuvre_associee: 1,
          type_produit: "replique"
        },
        {
          id: 3,
          nom: "Impression Oba Oguola - Format A2",
          description: "Impression haute qualité de l'œuvre Oba Oguola...",
          prix: 8000,
          categorie_id: 3,
          image_url: "/images/boutique/impression_oguala.jpg",
          stock: 100,
          statut: "disponible",
          oeuvre_associee: 2,
          type_produit: "impression"
        },
        {
          id: 4,
          nom: "Collier Perles Africaines",
          description: "Collier traditionnel inspiré des parures royales...",
          prix: 12000,
          categorie_id: 4,
          image_url: "/images/boutique/collier_perles.jpg",
          stock: 25,
          statut: "disponible",
          oeuvre_associee: null,
          type_produit: "bijou"
        },
        {
          id: 5,
          nom: "T-shirt Musée des Civilisations Noires",
          description: "T-shirt coton avec logo du musée...",
          prix: 6000,
          categorie_id: 5,
          image_url: "/images/boutique/tshirt_musee.jpg",
          stock: 80,
          statut: "disponible",
          oeuvre_associee: null,
          type_produit: "vetement"
        }
      ],
      commandes: [
        {
          id: 1,
          utilisateur_id: 10,
          numero_commande: "CMD-MCN-2024-001",
          statut: "payee",
          total: 15000,
          date_commande: "2024-01-15 14:30:00",
          adresse_livraison: "123 Avenue Bourguiba, Dakar",
          produits: [
            {
              produit_id: 1,
              quantite: 1,
              prix_unitaire: 15000
            }
          ],
          created_at: "2024-01-15 14:30:00"
        },
        {
          id: 2,
          utilisateur_id: 15,
          numero_commande: "CMD-MCN-2024-002",
          statut: "en_attente",
          total: 43000,
          date_commande: "2024-01-16 10:15:00",
          adresse_livraison: "456 Rue Khalifa, Dakar",
          produits: [
            {
              produit_id: 2,
              quantite: 1,
              prix_unitaire: 25000
            },
            {
              produit_id: 3,
              quantite: 2,
              prix_unitaire: 8000
            },
            {
              produit_id: 5,
              quantite: 1,
              prix_unitaire: 6000
            }
          ],
          created_at: "2024-01-16 10:15:00"
        },
        {
          id: 3,
          utilisateur_id: 20,
          numero_commande: "CMD-MCN-2024-003",
          statut: "livree",
          total: 24000,
          date_commande: "2024-01-17 16:45:00",
          adresse_livraison: "789 Boulevard de la République, Dakar",
          produits: [
            {
              produit_id: 3,
              quantite: 3,
              prix_unitaire: 8000
            }
          ],
          created_at: "2024-01-17 16:45:00"
        }
      ],
      inscriptions: [
        {
          id: 1,
          activite_id: 1,
          utilisateur_id: 10,
          date_inscription: "2024-02-10 09:00:00",
          statut: "confirmee",
          nombre_participants: 1,
          prix_total: 8000,
          created_at: "2024-02-10 09:00:00"
        },
        {
          id: 2,
          activite_id: 2,
          utilisateur_id: 15,
          date_inscription: "2024-02-12 14:30:00",
          statut: "en_attente",
          nombre_participants: 2,
          prix_total: 4000,
          created_at: "2024-02-12 14:30:00"
        },
        {
          id: 3,
          activite_id: 3,
          utilisateur_id: 20,
          date_inscription: "2024-02-15 11:00:00",
          statut: "confirmee",
          nombre_participants: 1,
          prix_total: 1000,
          created_at: "2024-02-15 11:00:00"
        },
        {
          id: 4,
          activite_id: 4,
          utilisateur_id: 25,
          date_inscription: "2024-02-18 16:45:00",
          statut: "confirmee",
          nombre_participants: 4,
          prix_total: 12000,
          created_at: "2024-02-18 16:45:00"
        }
      ]

    };
    // Variable pour le motif de rejet

    // Variable pour le motif de rejet
    $scope.motifRejet = '';

    // initAnnee
    $scope.initAnnee = function () {
      $scope.dataPage["annees"] = [];
      const currentYear = new Date().getFullYear();
      for (let year = currentYear; year >= 2020; year--) {
        let structure = {
          id: year,
          "designation": year
        }
        $scope.dataPage["annees"].push(structure);
      }

    }
    $scope.initAnnee();
    // Fonction pour obtenir le texte de l'état
    $scope.getEtatText = function (etat) {
      switch (etat) {
        case 'en_attente': return 'En attente';
        case 'valide': return 'Validé';
        case 'rejete': return 'Rejeté';
        default: return 'Inconnu';
      }
    };

    // Fonctions pour la page de détail
    $scope.voirDetailsVehicule = function (vehicule) {
      $scope.vehiculeSelectionne = vehicule;
      $('#detailVehiculeModal').modal('show');
    };

    $scope.exporterVehicules = function () {
      toastr.success('Export des véhicules en cours...');
      // Logique d'export ici
    };

    $scope.validerSoumission = function () {
      if (confirm('Êtes-vous sûr de vouloir valider cette soumission ?')) {
        $scope.soumissionnaire.etat = 'valide';
        $scope.soumissionnaire.date_validation = new Date();
        toastr.success('Soumission validée avec succès');

        // Forcer la mise à jour de l'affichage
        if (!$scope.$$phase) {
          $scope.$apply();
        }
      }
    };

    $scope.rejeterSoumission = function () {
      $scope.motifRejet = '';
      $('#rejetModal').modal('show');
    };

    $scope.confirmerRejet = function () {
      if (!$scope.motifRejet) {
        toastr.error('Veuillez saisir un motif de rejet');
        return;
      }

      $scope.soumissionnaire.etat = 'rejete';
      $scope.soumissionnaire.date_rejet = new Date();
      $scope.soumissionnaire.motif_rejet = $scope.motifRejet;

      $('#rejetModal').modal('hide');
      toastr.success('Soumission rejetée avec succès');

      // Forcer la mise à jour de l'affichage
      if (!$scope.$$phase) {
        $scope.$apply();
      }
    };

    $scope.mettreEnAttente = function () {
      $scope.soumissionnaire.etat = 'en_attente';
      $scope.soumissionnaire.date_soumission = new Date();
      toastr.info('Soumission mise en attente');

      // Forcer la mise à jour de l'affichage
      if (!$scope.$$phase) {
        $scope.$apply();
      }
    };

    $scope.modifierSoumission = function () {
      toastr.info('Modification de la soumission...');
      // Logique de modification ici
    };

    $scope.getStatusTexts = function (status) {
      switch (status) {
        case 0: return "En attente";
        case 1: return "Validé";
        case 3: return "Refusé";
        default: return "Inconnu";
      }
    };
    $scope.updateArticleStatus = function (newStatus) {

      newStatus = newStatus + 1;
      console.log($scope.selectedArticle.statut);
      if (newStatus == 1) {
        $scope.selectedArticle.etat_text = 'En attente Dr Achat';
      } else if (newStatus == 2) {
        $scope.selectedArticle.etat_text = 'En attente DG';
      } else if (newStatus == 3) {
        $scope.selectedArticle.etat_text = 'Validé';
      }
      $scope.selectedArticle.statut = newStatus;

      //alert('Statut mis à jour: ' + $scope.getStatusText(newStatus));
    };


    $scope.dejaCharger = false;
    $scope.valeurremisedureedevie = 0;
    $scope.$on("$routeChangeStart", function (next, current) {
      // $scope.select2();

      $scope.search = false;
      let id = current.params.itemId;
      $scope.id = id;
      $scope.orderby = null;
      $scope.filters = "";
      $scope.linknav = $location.path();
      $scope.currentTemplateUrl = null;
      $scope.dataInTabPane.fournisseurs_da.data = [];
      $scope.currentTemplateUrl = current.params.namepage
        ? current.params.namepage
        : "dashboard";
      let originalPath = $scope.currentTemplateUrl.split("/");

      if (originalPath && originalPath.length > 0) {
        $scope.permissionResources = originalPath[1];
      }

      //console.log('/******* Réintialisation de certaines valeurs *******/');
      $scope.linknav = $location.path();
      console.log("est refeniee");

      //Changement
      //nouveau element

      //Changement
      //nouveau element
      $scope.paginations = {
        role: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        user: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        permission: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        client: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        pointdevente: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        zone: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        visite: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        demande: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        preference: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        categorie: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        histogrammehebdommadaires: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },

        province: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        typemarche: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        da: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        parcourmarche: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
        axe: {
          currentPage: 1,
          maxSize: 10,
          entryLimit: ENTRYLIMIT,
          totalItems: 0,
        },
      };
      $scope.getelements("roles");


      if ($scope.currentTemplateUrl.toLowerCase().indexOf("list-") !== -1) {
        // TODO: delete
        let getNameItemOld = $scope.currentTemplateUrl.toLowerCase();
        let getNameItem = getNameItemOld.substring(5, getNameItemOld.length);
        console.log($scope.currentTemplateUrl);
        if (
          $scope.currentTemplateUrl.toLowerCase() !==
          "list-detailfichevisite" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-planning" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-validation" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-detailbl" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-detailzonepdv" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-report" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-detailexpressionbesoin" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-detailao" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-evaluationsfournisseur" &&
          $scope.currentTemplateUrl.toLowerCase() !== "list-detailtransporteurexterne"
        ) {

          if (getNameItem === 'fiche')
            getNameItem = "evaluationsfournisseur";

          if (getNameItem === 'chauffeur' && $scope.currentTemplateUrl.toLowerCase() == "list-chauffeur") {
            $scope.pageChanged(
              getNameItem,
              optionals = {
                justWriteUrl: null,
                option: null,
                saveStateOfFilters: false,
                order: null,
                queryfilters: "estinterne:0"
              }
            );
          } else if (getNameItem === 'transporteurexterne' && $scope.currentTemplateUrl.toLowerCase() == "list-transporteurexterne") {
            getNameItem = "chauffeur";
            $scope.pageChanged(
              getNameItem,
              optionals = {
                justWriteUrl: null,
                option: null,
                saveStateOfFilters: false,
                order: null,
                queryfilters: "estinterne:1"
              }
            );
          } else {
            $scope.pageChanged(getNameItem);
          }


        }

        if ($scope.currentTemplateUrl.toLowerCase() == "list-expressionbesoin") {
          $scope.getelements('typemarches');
          $scope.currentTemplateUrl = 'da'
        }

        if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-user") !== -1
        ) {
          $scope.titlePage = "Utilisateurs";
          $scope.getelements("roles");
          $scope.getelements("fournisseurs");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailao") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-detailao";
          $scope.getelements(
            "aos",
            null,
            (filtres = "id:" + id)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-role") !== -1
        ) {
          $scope.titlePage = "Roles";
          $scope.getelements("permissions");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-role") !== -1
        ) {
          $scope.titlePage = "Roles";
          $scope.getelements("permissions");
        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-typemarche") !== -1
        ) {
          $scope.titlePage = "Type marche";
          $scope.getelements("parcourmarches");
        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-axe") !== -1
        ) {
          $scope.titlePage = "Axes";
          $scope.getelements("provinces");
          $scope.getelements("tonnages");
        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-tonnage") !== -1
        ) {
          $scope.titlePage = "Tonnage transport";
          $scope.getelements("unites");
        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailoffretransport") !== -1
        ) {
          $scope.getelements("unites");
          // $scope.setActiveStep(1, null, 'transport');
          $scope.offretransportsaxes = $scope.dataPage['offretransports'].find(
            (offre) => offre.id === parseInt(id)
          );
          console.log($scope.offretransportsaxes, "offre transport");
          // Initialisation des validations
          $scope.offretransportsaxes.validation = $scope.offretransportsaxes.validation || {
            etat: '',
            dateSoumission: null,
            dateResAchat: null,
            dateDirAchat: null,
            dateDg: null
          };

          $scope.offretransportsaxes.validationDao = $scope.offretransportsaxes.validationDao || {
            etat: '',
            dateSoumission: null,
            dateResAchat: null,
            dateDirAchat: null,
            dateDg: null
          };

          $scope.daoData = $scope.daoData || {
            modeles: {
              modele1: false,
              modele2: false
            },
            date_pub: null,
            date_cloture: null,
            etat_publication: 0
          };

          $scope.activeStepTransport = 1;
          console.log($scope.offretransportsaxes, "offre transport");

        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-annuairetransporteur") !== -1
        ) {
          console.log($scope.dataPage.annuairetransporteurs, "annuaire transporteur");
          $scope.annuairetransporteurs = $scope.dataPage.annuairetransporteurs.find(
            (annuaire) => annuaire.offreId === parseInt(id)
          );
          console.log($scope.annuairetransporteurs);
          $scope.detailoffretransport = $scope.dataPage.offretransports.find(
            (offre) => offre.id === parseInt(id)
          );
          // Structure de données des soumissionnaires avec leurs véhicules
          $scope.soumissionnaires = $scope.dataPage.soumissionnaires;

          // Calcul du total des véhicules
          $scope.totalVehicules = $scope.dataPage.soumissionnaires.reduce((total, soumissionnaire) => {
            return total + soumissionnaire.vehicules.length;
          }, 0);

          // Ajouter le total de charge utile pour chaque soumissionnaire
          $scope.dataPage.soumissionnaires.forEach(soumissionnaire => {
            soumissionnaire.totalChargeUtile = soumissionnaire.vehicules.reduce((total, vehicule) => {
              return total + vehicule.charge_utile;
            }, 0);
          });

        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detaildossierannuairetransporteurs") !== -1
        ) {
          console.log($scope.dataPage.annuairetransporteurs, "annuaire transporteur");
          $scope.annuairetransporteurs = $scope.dataPage.annuairetransporteurs.find(
            (annuaire) => annuaire.id === parseInt(id)
          );
          console.log($scope.annuairetransporteurs);



        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-soumissionsannuaire") !== -1 && $scope.currentTemplateUrl === "list-soumissionsannuaire"
        ) {
          console.log($scope.dataPage.annuairetransporteurs, "annuaire transporteur");
          $scope.annuairetransporteurs = $scope.dataPage.annuairetransporteurs.find(
            (annuaire) => annuaire.id === parseInt(id)
          );
          console.log($scope.annuairetransporteurs);



        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-prequalification") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-prequalification";
          console.log("prequalificationssssssssssssssssssssssssss");
          $scope.getelements("pays");
          $scope.getelements("fournisseurs", null, (filtres = "TSSCOD_0_0 :1"));
          $scope.getelements("articles", null, (filtres = "TCLCOD_0:1"));

          $scope.getelements("fabricants");
        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-soumissionsannuairedetails") !== -1 && $scope.currentTemplateUrl === "list-soumissionsannuairedetails"
        ) {
          console.log($scope.dataPage.annuairetransporteurs, "annuaire transporteur");
          $scope.soumissionnaire = $scope.dataPage.soumissionnaires.find(
            (soumissionnaire) => soumissionnaire.id === parseInt(id)
          );
          console.log($scope.soumissionnaire);
        }
        else if (
          $scope.currentTemplateUrl
            .toLowerCase()
            .indexOf("list-pointdevente") !== -1
        ) {
          $scope.titlePage = "Point de ventes";
          $scope.getelements("clients");
          $scope.getelements("zones");
          $scope.getelements("categoriepointdeventes");
          $scope.getelements("typepointdeventes");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-client") !== -1
        ) {
          $scope.titlePage = "Client";
          $scope.getelements("categorieclients");
          $scope.getelements("typeclients");
          $scope.getelements("roles");
        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-equipegestionclient") !== -1
        ) {
          $scope.titlePage = "Equipe gestion client";
          $scope.getelements("clients");
          $scope.getelements("typeclients");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-article") !== -1 && $scope.currentTemplateUrl === "list-article"
        ) {
          $scope.titlePage = "Produits";
          //$scope.getelements("categories");
          // $scope.getelements("unites");

        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-equipegestion") !== -1
        ) {
          $scope.titlePage = "Equipe gestions";
          $scope.getelements("users");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-commande") !==
          -1
        ) {
          $scope.titlePage = "Preferences";
        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-programme") !==
          -1
        ) {
          $scope.titlePage = "Preferences";
          $scope.getelements("articles");
          $scope.getelements("bailleurs");
          $scope.getelements("equipegestions");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-campagne") !==
          -1
        ) {
          $scope.titlePage = "campagne";
          $scope.getelements("articles");
          $scope.getelements("programmes");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-phasedepot") !==
          -1
        ) {
          $scope.titlePage = "campagne";
          $scope.getelements("campagnes");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailprogramme") !==
          -1
        ) {
          $scope.titlePage = "details programme";
          $scope.getelements("articles");
          $scope.getelements("clients");
          console.log(id);
          $scope.getelements(
            "programmes",
            null,
            (filtres = "id:" + id)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-lignecommande") !==
          -1
        ) {
          $scope.titlePage = "details programme";
          console.log(id);
          $scope.getelements("articles");
          $scope.getelements(
            "programmes",
            null,
            (filtres = "id:" + id)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-bailleur") !==
          -1
        ) {
          $scope.titlePage = "bailleurs";
          $scope.getelements("articles");
          $scope.getelements(
            "programmes",
            null,
            (filtres = "id:" + id)
          );

        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailbailleur") !==
          -1
        ) {
          let params = id.split('-');
          let bailleurId = params[0];
          let programmeId = params[1];
          $scope.titlePage = "bailleurs";
          $scope.getelements(
            "bailleurs",
            null,
            (filtres = "id:" + bailleurId)
          );
          $scope.getelements(
            "programmes",
            null,
            (filtres = "id:" + programmeId)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailcampagne") !==
          -1
        ) {
          $scope.titlePage = "bailleurs";
          $scope.getelements("articles");
          $scope.getelements(
            "campagnes",
            null,
            (filtres = "id:" + id)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-validationstep") !==
          -1
        ) {
          $scope.titlePage = "bailleurs";
          $scope.getelements("articles");
          $scope.getelements(
            "campagnes",
            null,
            (filtres = "id:" + id)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailcampagneproduit") !==
          -1
        ) {
          $scope.titlePage = "bailleurs";
          $scope.getelements("articles");
          $scope.getelements(
            "campagnes",
            null,
            (filtres = "id:" + id)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-dossierclient") !==
          -1
        ) {
          $scope.titlePage = "bailleurs";
          $scope.getelements("articles");
          $scope.getelements(
            "campagnes",
            null,
            (filtres = "id:" + id)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detaildossierclient") !==
          -1
        ) {
          $scope.titlePage = "bailleurs";
          $scope.getelements("articles");
          $scope.getelements(
            "commandes",
            null,
            (filtres = "id:" + id)
          );
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailcommandesimuler") !== -1
        ) {
          // Recherche de la commande simulée dans les données statiques
          console.log(id, "id");
          $scope.commande = $scope.dataPage.commandestatics.find(c => c.id === parseInt(id));
          console.log($scope.dataPage.commandestatics, "detailcommandes");
          console.log($scope.commande, "commande");

          // Données initiales pour les articles
          $scope.commande.articles[0]['lot'] = 'LOT-GANTS-100 2025-09-04 75%PU 50000 230000';
          $scope.commande.articles[0]['prix'] = 50000;
          $scope.commande.articles[0]['stockAgence'] = 230000;
          $scope.commande.articles[0]['stockCentral'] = 450000;
          $scope.commande.articles[0]['peremption'] = '2025-09-04';
          $scope.commande.articles[0]['source'] = 'agence';
          $scope.commande.articles[0]['lotSelectionne'] = 'LOT-GANTS-100 2025-09-04 75%PU 50000 230000';

          // Définir la province de l'utilisateur (par défaut province du client)
          $scope.userProvince = $scope.commande.client.province || 'Antananarivo';

          // Mode d'approvisionnement par défaut
          $scope.commande.approvisionnement = 'agence';

          // Initialiser les valeurs des champs
          setTimeout(function () {
            $("#datepremption0").val('2025-09-04').trigger('change');
            $scope.lot = 'LOT-GANTS-100 2025-09-04 75%PU 50000 230000';
            $("#lotselect").val('LOT-GANTS-100 2025-09-04 75%PU 50000 230000').trigger('change');
            $scope.$apply();
          }, 100);
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailao") !==
          -1
        ) {
          // Recherche de la commande simulée dans les données statiques
          console.log(id, "id");
          $scope.appelOffre = $scope.dataPage.appeldoffres.find(c => c.id === parseInt(id));
          console.log($scope.dataPage.appeldoffres, "detailcommandes");
          console.log($scope.appelOffre, "commande");
          // Initialisation des soumissions fournisseurs si elles n'existent pas
          // $scope.appelOffre.daoData.suppliers.forEach(supplier => {
          //   supplier.dossierfournisseur = supplier.dossierfournisseur || {
          //     soumissions: $scope.appelOffre.articles.map(article => ({
          //       articleId: article.id,
          //       prixUnitaire: null,
          //       conditionLivraison: 'DDP',
          //       commentaireCondition: '',
          //       documents: {
          //         ordreTransit: null,
          //         transitaire: null,
          //         cabinetExpertise: null,
          //         domiciliationFacture: null,
          //         MIDAC: null
          //       },
          //       statut: 'en_attente' // en_attente, soumis, rejeté, accepté
          //     })),
          //     penalites: {
          //       retardLivraison: false,
          //       montantDeduit: 0,
          //       motifs: []
          //     }
          //   };
          // });
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-dossiersoumission") !== -1
        ) {
          $scope.getelements("typeconditions");
          $scope.getelements("pays");

          $scope.getelements("fournisseurs", null, (filtres = "TSSCOD_0_0 :1"));
          $scope.getelements("articles", null, (filtres = "TCLCOD_0:1"));

          $scope.getelements("fabricants");

          $scope.getelements("aos", null, (filtres = "id:" + id));
          $scope.$watch("dataPage['aos']", function (newVal, oldVal) {
            if (newVal && newVal.length > 0) {

            }
          });
          // Quand les AOS changent
          $scope.$watch("dataPage['aos']", function (newVal, oldVal) {
            if (newVal && newVal.length > 0) {
              angular.forEach(newVal[0].soumissions, function (soumission) {
                if (soumission.soumissionarticles) {
                  angular.forEach(soumission.soumissionarticles, function (article) {

                    // Simuler CDS et CDF
                    article.cds = "Boîte"; // ex. valeur fixe ou random
                    article.cdf = "Carton";

                    // Simuler des détails supplémentaires
                    article.detailSimule = {
                      numLot: "LOT-" + Math.floor(Math.random() * 10000),
                      quantite: article.quantitepropose || 100,
                      datePeremption: "2026-12-31",
                      fabricant: soumission.fournisseur.nom || "Laboratoire XYZ"
                    };
                  });
                }
              });
            }
          });

          $scope.showDetailLigne = function (soumissionArticle) {
            console.log(soumissionArticle, "soumissionArticle.detailSimule");

            if (soumissionArticle && soumissionArticle.isarticletemplate == 0) {
              $("#lof_date_premption").hide(); // cache l'élément
            }

            $scope.currentDetailArticle = angular.copy(soumissionArticle.detailSimule);
            $scope.currentDetailArticle.isarticletemplate = soumissionArticle.isarticletemplate;

            $('#detailLigne').modal('show');
          };


        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-suivimarchefournisseur") !== -1 && $scope.currentTemplateUrl === "list-suivimarchefournisseur"
        ) {
          $scope.getelements(
            "soumissions",
            null,
            (filtres = "id:" + id)
          );

          $scope.$watch("dataPage['soumissions']", function (newVal, oldVal) {
            if (newVal && newVal.length > 0) {
              $scope.initializeSuiviMarcheData(newVal);
            }
          });
          $scope.getMontantTotale = function () {
            if (!$scope.supplier || !$scope.supplier.dossierfournisseur.soumissions) return 0;

            let total = 0;

            $scope.supplier.dossierfournisseur.soumissions.forEach(function (soumission) {
              console.log(soumission, "soumission pour calcul montant");

              // Utiliser les bons champs : quantité proposée × prix unitaire proposé
              const quantite = soumission.quantiteLivree || 0; // Quantité livrée/proposée
              const prix = soumission.prixunitairepropose || 0; // Prix unitaire proposé

              total += quantite * prix;
            });

            console.log("Montant total calculé:", total);
            return total;
          };
          $scope.supplier = {
            expeditionValidee: false,
            documentsExpeditionValides: false,
            documentsExpeditionRejetes: false,
            dossierfournisseur: {
              soumissions: []
            }
          };
          $scope.initializeSuiviMarcheData = function (soumissionsData) {
            // Récupérer la soumission
            $scope.soumission = soumissionsData[0];
            console.log($scope.soumission, "dnlm");

            // Mettre à jour le supplier avec les données de la soumission
            $scope.supplier = {
              id: $scope.soumission.id,
              name: $scope.soumission.fournisseur.nom,
              type: $scope.soumission.fournisseur.categoriefournisseur.designation,
              delaiLivraison: $scope.soumission.delaiLivraison || `${Math.floor(Math.random() * 30) + 5} jours`,
              bcNumber: $scope.soumission.bcNumber || `BC-${Math.floor(1000 + Math.random() * 9000)}`,
              datearrivage: $scope.soumission.datearrivage || new Date(Date.now() + (14 + Math.floor(Math.random() * 14)) * 24 * 60 * 60 * 1000),
              validated: $scope.soumission.etatcontractel === "1",
              expeditionValidee: false, // CHANGEMENT ICI : Toujours true pour permettre l'édition
              documentsExpeditionValides: $scope.supplier.documentsExpeditionValides || false,
              documentsExpeditionRejetes: $scope.supplier.documentsExpeditionRejetes || false,
              motifRejetDocuments: $scope.supplier.motifRejetDocuments || "",
              isarticletemplate: $scope.soumission.isarticletemplate,

              // Structure pour les soumissions (articles)
              dossierfournisseur: {
                soumissions: $scope.supplier.dossierfournisseur.soumissions || []
              }
            };

            // Initialiser les articles de la soumission
            if ($scope.soumission.soumissionarticles && $scope.soumission.soumissionarticles.length > 0) {
              $scope.supplier.dossierfournisseur.soumissions = $scope.soumission.soumissionarticles.map(function (article) {
                return {
                  articleId: article.article_id,
                  fabriquantSoumission: article.fabricant ? article.fabricant.designation : 'Non spécifié',
                  fabriquantLivraison: '',
                  fabriquantDifferent: false,
                  conditionLivraison: article.typecondition ? article.typecondition.designation : 'DDP',
                  delaiLivraison: article.delailivraison,
                  datePeremption: new Date(Date.now() + 365 * 24 * 60 * 60 * 1000), // 1 an plus tard
                  quantiteLivree: article.quantitepropose,
                  prixunitairepropose: article.prixunitairepropose,
                  ecartLivraison: article.quantitedemande - article.quantitepropose,
                  quantitedemande: article.quantitedemande,
                  targetprice: article.targetprice,
                  statutLivraison: 'en_attente',
                  livre: false,
                  nonConformite: false,
                  // Données de l'article
                  article: article.article,
                  fabricant: article.fabricant,
                  typecondition: article.typecondition
                };
              });
            }

            // Initialiser les données d'expédition
            $scope.initializeExpedition();
            $scope.initializeExpeditionDocuments();

            console.log('Supplier initialisé:', $scope.supplier);
          };


          $scope.initializeExpedition = function () {
            $scope.nonConformites = $scope.nonConformites || [];
            $scope.currentNonConformite = $scope.currentNonConformite || {};
          };


          $scope.initializeExpeditionDocuments = function () {
            $scope.requiredDocumentssuivimarche = $scope.requiredDocumentssuivimarche || [];

            if ($scope.dataPage['documentspecifications'] && $scope.dataPage['documentspecifications'].length > 0) {
              for (let i = 0; i < $scope.dataPage['documentspecifications'].length; i++) {
                if ($scope.dataPage['documentspecifications'][i]['etape'] === "Suivi marché") {
                  $scope.requiredDocumentssuivimarche.push({
                    name: $scope.dataPage['documentspecifications'][i]['designation'],
                    nature: $scope.dataPage['documentspecifications'][i]['designation'],
                    required: true,
                    date: null
                  });
                }
              }
            }
          };


          $scope.getLivraisonStatus = function () {
            if (!$scope.supplier || !$scope.supplier.dossierfournisseur || !$scope.supplier.dossierfournisseur.soumissions) {
              return 'en_attente';
            }

            const soumissions = $scope.supplier.dossierfournisseur.soumissions;
            const totalSoumissions = soumissions.length;
            const completCount = soumissions.filter(s => s.statutLivraison === 'complet').length;
            const partielCount = soumissions.filter(s => s.statutLivraison === 'partiel').length;

            if (completCount === totalSoumissions) return 'complet';
            if (partielCount > 0 || completCount > 0) return 'en_cours';
            return 'en_attente';
          };


          $scope.getLivraisonStatusText = function () {
            const status = $scope.getLivraisonStatus();
            switch (status) {
              case 'complet': return 'Livraison complète';
              case 'en_cours': return 'Livraison en cours';
              case 'en_attente': return 'En attente';
              default: return 'Non défini';
            }
          };

          // CORRECTION : Simplifier canValidateExpedition pour le debug
          $scope.canValidateExpedition = function () {
            if (!$scope.supplier) {
              console.log('canValidateExpedition: supplier undefined');
              return false;
            }

            const canValidate = !$scope.supplier.expeditionValidee &&
              $scope.supplier.documentsExpeditionValides &&
              $scope.getLivraisonStatus() === 'complet';

            console.log('canValidateExpedition:', {
              expeditionValidee: $scope.supplier.expeditionValidee,
              documentsExpeditionValides: $scope.supplier.documentsExpeditionValides,
              livraisonStatus: $scope.getLivraisonStatus(),
              result: canValidate
            });

            return canValidate;
          };

          // CORRECTION : Modifier validateExpedition pour basculer l'état
          $scope.validateExpedition = function (supplier) {
            if ($scope.canValidateExpedition()) {
              supplier.expeditionValidee = true;
              console.log('Expédition validée pour:', supplier.name);

              // Désactiver les champs après validation
              $scope.$applyAsync();
            } else {
              console.log('Validation impossible. Conditions:', {
                expeditionValidee: supplier.expeditionValidee,
                documentsExpeditionValides: supplier.documentsExpeditionValides,
                livraisonStatus: $scope.getLivraisonStatus()
              });
            }
          };
          // Initialiser les autres propriétés


          $scope.calculateEcartLivraison = function (soumission) {
            const quantiteCommandee = soumission.article ? soumission.article.quantite || 0 : 0;
            soumission.ecartLivraison = soumission.quantiteLivree - quantiteCommandee;
            $scope.updateStatutLivraison(soumission); // Ajouter cet appel

          };
          $scope.updateStatutLivraison = function (soumission) {
            // NE PAS réécrire soumission.statutLivraison ici
            // La valeur est déjà mise à jour par ng-model

            // Juste mettre à jour les états liés si nécessaire
            const quantiteCommandee = soumission.article ? soumission.article.quantite || 0 : 0;

            // Si le statut est changé manuellement en "complet", forcer la quantité livrée
            if (soumission.statutLivraison === 'complet') {
              soumission.quantiteLivree = quantiteCommandee;
              soumission.livre = true;
            }
            // Si le statut est changé en "en_attente", réinitialiser
            else if (soumission.statutLivraison === 'en_attente') {
              soumission.quantiteLivree = 0;
              soumission.livre = false;
            }

            // Recalculer l'écart
            soumission.ecartLivraison = soumission.quantiteLivree - quantiteCommandee;
          };

          $scope.updateLivraisonStatus = function (soumission) {
            if (soumission.livre) {
              soumission.quantiteLivree = soumission.article ? soumission.article.quantite || 0 : 0;
            } else {
              soumission.quantiteLivree = 0;
            }
            $scope.calculateEcartLivraison(soumission);
            $scope.updateStatutLivraison(soumission);
          };

          $scope.verifierFabriquant = function (soumission) {
            soumission.fabriquantDifferent =
              soumission.fabriquantLivraison &&
              soumission.fabriquantLivraison !== soumission.fabriquantSoumission;
          };

          $scope.getArticleById = function (articleId) {
            // Rechercher l'article dans les soumissions
            for (let soumission of $scope.supplier.dossierfournisseur.soumissions) {
              if (soumission.article && soumission.article.id == articleId) {
                return soumission.article;
              }
            }
            return { designation: 'Non trouvé', prixUnitaire: 0, quantite: 0 };
          };

          // Gestion des non-conformités
          $scope.openNonConformiteModal = function (soumission) {
            $scope.currentNonConformite = {
              articleId: soumission.articleId,
              type: 'qualite',
              description: '',
              gravite: 'mineure',
              actionCorrective: '',
              date: new Date()
            };
            $('#nonConformiteModal').modal('show');
          };

          $scope.saveNonConformite = function () {
            if ($scope.currentNonConformite.description) {
              $scope.nonConformites.push(angular.copy($scope.currentNonConformite));
              $('#nonConformiteModal').modal('hide');

              // Marquer la soumission comme ayant une non-conformité
              const soumission = $scope.supplier.dossierfournisseur.soumissions.find(
                s => s.articleId == $scope.currentNonConformite.articleId
              );
              if (soumission) {
                soumission.nonConformite = true;
              }

              $scope.currentNonConformite = {};
            }
          };

          $scope.getNonConformitesHistory = function () {
            return $scope.nonConformites || [];
          };

          $scope.getArticleDesignation = function (articleId) {
            const article = $scope.getArticleById(articleId);
            return article.designation;
          };

          $scope.getTypeText = function (type) {
            const types = {
              'qualite': 'Problème de qualité',
              'quantite': 'Quantité incorrecte',
              'delai': 'Retard de livraison',
              'emballage': 'Emballage endommagé',
              'document': 'Document manquant',
              'autre': 'Autre problème'
            };
            return types[type] || type;
          };

          $scope.getGraviteText = function (gravite) {
            const gravites = {
              'mineure': 'Mineure',
              'majeure': 'Majeure',
              'critique': 'Critique'
            };
            return gravites[gravite] || gravite;
          };

          $scope.deleteNonConformite = function (nc, index) {
            $scope.nonConformites.splice(index, 1);
          };

          // Gestion des documents d'expédition
          $scope.validerDocumentsExpedition = function () {
            $scope.supplier.documentsExpeditionValides = true;
            $scope.supplier.documentsExpeditionRejetes = false;
            console.log('Documents d\'expédition validés');
            $scope.$applyAsync(); // Forcer la mise à jour
          };

          $scope.rejeterDocumentsExpedition = function () {
            $('#rejetDocumentsModal').modal('show');
          };

          $scope.confirmerRejetDocuments = function () {
            if ($scope.motifRejetDocuments) {
              $scope.supplier.documentsExpeditionValides = false;
              $scope.supplier.documentsExpeditionRejetes = true;
              $scope.supplier.motifRejetDocuments = $scope.motifRejetDocuments;
              $scope.motifRejetDocuments = '';
              $('#rejetDocumentsModal').modal('hide');
              console.log('Documents d\'expédition rejetés');
            }
          };

          $scope.reouvrirValidationDocuments = function () {
            $scope.supplier.documentsExpeditionValides = false;
            $scope.supplier.documentsExpeditionRejetes = false;
            $scope.supplier.motifRejetDocuments = '';
            console.log('Validation des documents rouverte');
          };

          console.log('Module suivi marché fournisseur initialisé');
        } else if (
          $scope.currentTemplateUrl === 'list-contractuelle') {

          $scope.getelements("soumissions", null, (filtres = "id:" + id));
          var codeFournisseur = 'MF9MCDLN016'
          var codeMarche = 'AON-2509-8744'

          var data_objet = {
            "BPSNUM_0": codeFournisseur,
            "YNUMMARCHE_0": codeMarche
          }
          console.log('Data object', data_objet);

          Init.chargeData("bcentete_Sage", data_objet).then(
            function (data) {
              console.log('Data response', data);
              if (data.data && !data.errors) {

              } else {
                $scope.showToast(title, data.errors_debug, "error");
              }
            },
            function (msg) {
              $scope.showToast(title, msg, "error");
            }
          );


        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-livraisonfournisseur") !==
          -1
        ) {
          $scope.supplier = $scope.appelOffre.daoData.suppliers.find(c => c.id === parseInt(id));
          // Initialiser les non-conformités si elles n'existent pas
          if (!$scope.supplier.expedition.nonConformites) {
            $scope.supplier.expedition.nonConformites = [];
          }
          $scope.supplier.dossierfournisseur.soumissions.forEach(s => {
            s.quantiteLivree = s.quantiteLivree || 0;
            s.quantiteAvarier = s.quantiteAvarier || 0;
            s.conformite = s.conformite || 'conforme';
          });
          console.log($scope.supplier, "supplier");

        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailarticlespecs") !==
          -1
        ) {
          let params = id.split('-');
          let appelOffreId = params[1];

          let articleId = params[0];
          $scope.appelOffre = $scope.dataPage.appeldoffres.find(c => c.id === parseInt(appelOffreId));
          $scope.article = $scope.appelOffre.articles.find(c => c.id === parseInt(articleId));
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailarticlesoumission") !==
          -1
        ) {
          let params = id.split('-');
          let appelOffreId = params[1];
          let articleId = params[0];
          $scope.appelOffre = $scope.dataPage.appeldoffres.find(c => c.id === parseInt(appelOffreId));
          $scope.article = $scope.appelOffre.articles.find(c => c.id === parseInt(articleId));
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-dao") !== -1
        ) {
          console.log(id, "id");
          $scope.selectedTargetprice = $scope.dataPage.targetprices.find(c => c.id === parseInt(id));

          // Initialisation des lspécifications pour chaque article
          $scope.selectedTargetprice.articles.forEach(article => {
            article.specs = article.specs || {
              description: '',
              normes: '',
              documents: []
            };
            article.currentDocTab = 'add';
          });

          // Initialisation des données DAO
          $scope.daoData = $scope.selectedTargetprice.daoData || {
            procedureType: '',
            status: 'draft',
            suppliers: [], // Ajout de la liste des fournisseurs
            date_ouverture: null,
            date_cloture: null,
            budget: null
          };

          $scope.criteresEvaluation = $scope.selectedTargetprice.criteresEvaluation || [
            { label: 'Prix', selected: true, ponderation: 40 },
            { label: 'Délai de livraison', selected: true, ponderation: 20 },
            { label: 'Expérience similaire', selected: true, ponderation: 15 },
            { label: 'Qualité technique', selected: true, ponderation: 25 }
          ];

          $scope.requiredDocuments = $scope.selectedTargetprice.requiredDocuments || [
            { name: 'Attestation de régularité fiscale', required: true },
            { name: 'Extrait K-bis', required: true },
            { name: 'Références clients', required: false },
            { name: 'Certificat de qualification', required: false }
          ];

          $scope.daoDocuments = $scope.selectedTargetprice.daoDocuments || [
            {
              name: 'Cahier des charges',
              description: 'Document détaillant les exigences techniques',
              file: null
            },
            {
              name: 'Règlement de consultation',
              description: 'Règles de la procédure',
              file: null
            }
          ];
          // Nouvel objet pour ajouter des fournisseurs
          $scope.newSupplier = {
            name: '',
            contact: '',
            email: '',
            phone: '',
            experience: 0
          };

          $scope.newTechDoc = {
            name: '',
            file: null
          };
          // Ajouter la liste complète des fournisseurs disponibles
          $scope.allSuppliers = $scope.dataPage.fournisseurs || [];
          $scope.selectedSupplier = null;
          // Initialiser la liste des fournisseurs sélectionnés si elle n'existe pas
          $scope.daoData.suppliers = $scope.daoData.suppliers || [];

          // Dans la section d'initialisation du DAO
          $scope.daoData.annexes = $scope.selectedTargetprice.daoData?.annexes || {
            fnrs: {
              cahier_charges: true,
              reglement_consultation: true,
              modele_contrat: true
            },
            soumissionnaires: {
              attestation_fiscale: true,
              extrait_kbis: true,
              references_clients: false,
              certificat_qualification: false,
              autres_documents: false,
              autres_documents_libelle: ''
            }
          };

          // Dans la section d'initialisation du DAO, ajouter :
          $scope.validationStatus = $scope.selectedTargetprice.validationStatus || {
            resAchat: { validated: null, comment: '', date: null },
            dirAchat: { validated: null, comment: '', date: null },
            pharmaResp: { validated: null, comment: '', date: null },
            dg: { validated: null, comment: '', date: null }
          };
          $scope.currentValidationStep = 'resAchat'; // Initialiser à la première étape

        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-articlespecs") !==
          -1 && $scope.currentTemplateUrl === 'list-articlespecs'
        ) {
          // Réinitialiser les variables à chaque chargement
          $scope.selectedArticle = null;
          $scope.selectedTargetprice = null;
          $scope.currentDocTab = 'add';
          $scope.newTechDoc = { name: '', file: null };
          let params = id.split('-');
          let targetPriceId = params[1];
          let articleId = params[0];
          console.log(targetPriceId, "targetPriceId", articleId, "articleId", id, "id");

          // Trouver le target price
          $scope.selectedTargetprice = $scope.dataPage.targetprices.find(c => c.id === parseInt(targetPriceId));
          console.log($scope.dataPage.targetprices, "detailcommandes");
          if (!$scope.selectedTargetprice) {
            console.error("Target price non trouvé");
            return;
          }

          // Trouver l'article
          $scope.selectedArticle = $scope.selectedTargetprice.articles.find(a => a.id === parseInt(articleId));
          console.log($scope.selectedArticle, "detailcommandes");
          if (!$scope.selectedArticle) {
            console.error("Article non trouvé");
            return;
          }

          // Initialisation robuste des specs
          if (!$scope.selectedArticle.specs) {
            $scope.selectedArticle.specs = {
              description: '',
              normes: '',
              documents: []
            };
          } else {
            // S'assurer que documents existe
            $scope.selectedArticle.specs.documents = $scope.selectedArticle.specs.documents || [];
          }

          $scope.currentDocTab = 'add';
          $scope.newTechDoc = {
            name: '',
            file: null
          };
          // Dans la section d'initialisation de l'article
          $scope.selectedArticle.conditionnement = $scope.selectedArticle.conditionnement || {
            type: '',
            quantite: null,
            type_autre: '',
            longueur: null,
            largeur: null,
            hauteur: null,
            poids_net: null,
            poids_brut: null,
            volume: null,
            instructions: '',
            conservation: '',
            conservation_autre: ''
          };


        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-dossierfournisseur") !==
          -1
        ) {
          // Recherche de la commande simulée dans les données statiques
          console.log(id, "id");
          let result = $scope.dataPage.appeldoffres.find(c => c.id === parseInt(id));
          $scope.listdossiers = result?.dossierFournisseurs;
          console.log($scope.listdossiers, "detailcommandes");
          console.log($scope.listdossiers, "commande");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detaildossierfournisseur") !==
          -1
        ) {
          // Recherche de la commande simulée dans les données statiques
          console.log(id, "id");
          console.log($scope.listdossiers, "detailcommandes");
          $scope.dossierFournisseur = $scope.listdossiers.find(c => c.id === parseInt(id));
          console.log($scope.dossierFournisseur, "detailcommandes");
          console.log($scope.dossierFournisseur, "commande");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailexpressionbesoin") !==
          -1
        ) {
          console.log(id, "id");
          $scope.getbesoin = $scope.dataPage.besoins.find(c => c.id === parseInt(id));
          $scope.articlesbesoin = $scope.getbesoin;
          $scope.articlesbesoins = $scope.getbesoin?.articles;
          // Initialisation des états textuels si non définis
          if (!$scope.articlesbesoin.etat_text) {
            switch ($scope.articlesbesoin.isqtevalide) {
              case 0:
                $scope.articlesbesoin.etat_text = "En attente de validation";
                $scope.articlesbesoin.etat_badge = "warning";
                break;
              case 1:
                $scope.articlesbesoin.etat_text = "Validé";
                $scope.articlesbesoin.etat_badge = "success";
                break;
              case 3:
                $scope.articlesbesoin.etat_text = "Annulé";
                $scope.articlesbesoin.etat_badge = "danger";
                break;
            }
          }
          console.log($scope.articlesbesoins);
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-preparation") !==
          -1
        ) {

          $scope.souscats = [
            {
              "nom": "Prestation intellectuelle",
              "id": 1
            },
            {
              "nom": "Transit",
              "id": 2
            },
            {
              "nom": "Expert",
              "id": 3
            }
            ,
            {
              "nom": "Informatique",
              "id": 3
            }

          ];
          $scope.souscatsmed = [
            {
              "nom": "Statine(Medicament hypolipemiant)",
              "id": 1
            },
            {
              "nom": "Antibiotique",
              "id": 2
            },
            {
              "nom": "Analgesique",
              "id": 3
            }

          ];

          $scope.validateFabricant = function (fabricantId) {
            // Confirmation avant validation
            if (!confirm("Êtes-vous sûr de vouloir valider ce fabricant ?")) {
              return;
            }


          };


          // $scope.getbesoin = $scope.dataPage.besoins.find(c => c.id === parseInt(id));

          $scope.getelements("documentspecifications");
          $scope.getelements(
            "detailsdas",
            null,
            (filtres = "da_id:" + id)
          );
          $scope.getelements(
            "typemarches",
            null,
            (filtres = "code:" + id)
          );

          var typeAvecS = "das";
          rewriteReq = typeAvecS + "(id:" + id + ")";
          Init.getElement(
            rewriteReq,
            listofrequests_assoc[typeAvecS]
          ).then(
            function (data) {
              console.log("data", data['data'][0]);
              if (data && data['data'] && data['data'].length > 0) {
                $scope.getbesoin = data['data'][0];
                console.log("data", $scope.getbesoin);
              }
            },
            function (msg) {
              $scope.showToast("", msg, "error");
            }
          );


          // $scope.getbesoin = $scope.dataPage['das'].find(c => c.id === parseInt(id));
          // console.log($scope.getbesoin);

          $scope.articlesbesoin = $scope.getbesoin;
          $scope.articlesbesoins = $scope.getbesoin?.articles;
          $scope.getTargetprice = $scope.dataPage.targetprices.find(c => c.besoinId === parseInt(id));
          $scope.targetprice = $scope.getTargetprice;
          $scope.targetpricesarticles = $scope.getTargetprice?.articles;

        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-suivimarche") !== -1 && $scope.currentTemplateUrl == "list-suivimarche"
        ) {
          $scope.getbesoin = $scope.dataPage.besoins.find(c => c.id === parseInt(id));

          if ($scope.getbesoin) {
            console.log('Besoin trouvé:', $scope.getbesoin);

            // Récupérer le target price associé
            $scope.getTargetprice = $scope.dataPage.targetprices.find(c => c.besoinId === parseInt(id));

            if ($scope.getTargetprice) {
              console.log('Target price trouvé:', $scope.getTargetprice);

              // Récupérer le DAO associé
              $scope.daoData = $scope.getTargetprice.daoData || {};
              console.log('DAO data:', $scope.daoData);

              // Initialiser les données de suivi marché
              $scope.initializeSuiviMarche();
            } else {
              console.error('Target price non trouvé pour le besoin ID:', id);
            }
          } else {
            console.error('Besoin non trouvé avec ID:', id);
          }

          // $scope.appelOffre = $scope.dataPage.appeldoffres.find(c => c.id === parseInt(appelOffreId));

          // if (!$scope.appelOffre) {
          //   const savedState = localStorage.getItem(storageKey);
          //   if (savedState) {
          //     $scope.appelOffre = JSON.parse(savedState);
          //     console.log("Données chargées depuis localStorage");
          //   }
          // }

          // if ($scope.appelOffre) {
          //   $scope.supplier = $scope.appelOffre.daoData.suppliers.find(c => c.id === parseInt(supplierId));

          //   // INITIALISATION DIRECTE DES PROPRIÉTES MANQUANTES
          //   if ($scope.supplier) {
          //     $scope.supplier.delaiLivraison = $scope.supplier.delaiLivraison || `${Math.floor(Math.random() * 30) + 5} jours`;
          //     $scope.supplier.bcNumber = $scope.supplier.bcNumber || `BC-${Math.floor(1000 + Math.random() * 9000)}`;
          //     $scope.supplier.datearrivage = $scope.supplier.datearrivage || new Date(Date.now() + (14 + Math.floor(Math.random() * 14)) * 24 * 60 * 60 * 1000);
          //   }
          // }

          // $scope.initializeExpedition();
          // $scope.initializeExpeditionDocuments();
          // console.log($scope.supplier, "supplier suivimarchefournisseur");
          // if ($scope.dataPage['documentspecifications'] && $scope.dataPage['documentspecifications'].length > 0) {
          //   for (let i = 0; i < $scope.dataPage['documentspecifications'].length; i++) {
          //     if ($scope.dataPage['documentspecifications'][i]['etape'] === "Suivi marché") {
          //       if (!$scope.requiredDocumentssuivimarche || $scope.requiredDocumentssuivimarche.length < 0) {
          //         $scope.requiredDocumentssuivimarche = [];
          //       }
          //       $scope.requiredDocumentssuivimarche.push(
          //         {
          //           name: $scope.dataPage['documentspecifications'][i]['designation'],
          //           nature: $scope.dataPage['documentspecifications'][i]['designation'],
          //           required: true
          //         }
          //       );
          //     }
          //   }
          // }
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-targetprice") !==
          -1
        ) {
          console.log(id, "id");
          console.log(id, "id");
          $scope.selectedTargetprice = $scope.dataPage.targetprices.find(c => c.id === parseInt(id));

          if ($scope.selectedTargetprice) {
            $scope.articlestargetprices = $scope.selectedTargetprice.articles || [];

            // Initialiser les prix unitaires si non définis
            $scope.articlestargetprices.forEach(article => {
              article.prixUnitaire = article.prixUnitaire || 0;
            });
          }
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-ao") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-ao";
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-documentspecification") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-documentspecification";
          $scope.getelements("typemarches");
          $scope.categoriedas = [
            {
              id: 1,
              designation: "MEDICAMENT"
            },
            {
              id: 2,
              designation: "BIENS ET SERVICES"
            }
          ]
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-statutamm") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-statutamm";
          $scope.getelements("fournisseurs", null, (filtres = "TSSCOD_0_0 :1"));
          $scope.getelements("articles", null, (filtres = "TCLCOD_0:1"));
          $scope.getelements("fabricants");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-evaluationsfournisseur") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-evaluationsfournisseur";
          $scope.getelements("mesures");
          $scope.getelements("criteres");
          $scope.getelements("fournisseurs", null, (filtres = "id:" + $scope.id));
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-ficheevaluation") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-ficheevaluation";
          $scope.getelements("criteres");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-vehicule") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-vehicule";
          $scope.getelements("tonnages");
          $scope.getelements("chauffeurs");
          $scope.getelements("typevehicules");
        } else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-parking") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-parking";
          $scope.getelements("fournisseurs");
          $scope.getelements("vehicules");
        }
        else if (
          $scope.currentTemplateUrl.toLowerCase().indexOf("list-detailtransporteurexterne") !==
          -1
        ) {
          $scope.currentTemplateUrl = "list-detailtransporteurexterne";
          $scope.getelements("fournisseurs", null, (filtres = "id:" + $scope.id));
        }

      }

    });


    $scope.addcompteclient = function (type = null, index = null) {
      if (!type) {

        var role_id = $("#role_detailequipegestionclient_equipegestionclient").val();
        var login = $("#login_detailequipegestionclient_equipegestionclient").val();
        var mdp = $("#password_detailequipegestionclient_equipegestionclient").val();
        console.log(login, mdp);
        var roles = null;
        if (role_id) {
          roles = $scope.dataPage['roles'].find(c => c.id === role_id);
        }

        console.log(roles);
        var typeclients = [];

        for (var i = 0; i < $scope.dataPage['typeclients'].length; i++) {
          if ($scope.dataPage['typeclients'][i]['id']) {
            var typeclientchecked = $("#" + $scope.dataPage['typeclients'][i]['id'] + "_detailequipegestionclient_equipegestionclient:checked").val();
            if (typeclientchecked && typeclientchecked == 1) {
              typeclients.push($scope.dataPage['typeclients'][i]);
            }
          }
        }
        if (login && mdp && typeclients && typeclients.length > 0) {

          $scope.dataInTabPane.detailequipegestionclient_equipegestionclient.data.push(
            {
              "login": login,
              "mdp": mdp,
              "role": roles,
              "typeclients": typeclients
            }
          );

        }

      } else {

        $scope.dataInTabPane.detailequipegestionclient_equipegestionclient.data.splice(index, 1);

      }

    }

    $scope.typeclients = [];

    $scope.valideEquipeGestion = function () {
      var clients = $("#client_equipegestionclient").val();
      if (clients && clients.length > 0) {
        $scope.typeclients = [];
        for (var i = 0; i < clients.length; i++) {
          var searchClient = $scope.dataPage['clients'].find(c => c.id === clients[i]);
          console.log(searchClient);

          if (searchClient['clienttypeclients'] && searchClient['clienttypeclients'].length > 0) {
            console.log(searchClient['clienttypeclients'][0]);
            if (searchClient['clienttypeclients'][0]['typeclient']) {
              var searchtypeclient = $scope.typeclients.find(c => c.id === searchClient['clienttypeclients'][0]['typeclient']['id']);
              if (!searchtypeclient) {
                $scope.typeclients.push(searchClient['clienttypeclients'][0]['typeclient']);
              }

            }

          }

        }
      }

      console.log($scope.typeclients);

    }



    $scope.changeStateAnnuaire = function (action) {
      console.log('Action demandée:', action);

      if (action === 'publie') {
        // Simuler la publication - état 1
        if (!$scope.annuairetransporteurs.daoData) {
          $scope.annuairetransporteurs.daoData = {};
        }
        $scope.annuairetransporteurs.daoData.etat_publication = 1; // État publié
        $scope.annuairetransporteurs.daoData.date_publication = new Date();

        // Définir une date de clôture par défaut (30 jours après la publication)
        var dateCloture = new Date();
        dateCloture.setDate(dateCloture.getDate() + 30);
        $scope.annuairetransporteurs.daoData.date_cloture = dateCloture;

        toastr.success('Annuaire publié avec succès');
      }
      else if (action === 'cloture') {
        // Simuler la clôture - état 2
        if ($scope.annuairetransporteurs.daoData) {
          $scope.annuairetransporteurs.daoData.etat_publication = 2; // État clôturé
          $scope.annuairetransporteurs.daoData.date_cloture = new Date();
          toastr.success('Annuaire clôturé avec succès');
        }
      }
      else if (action === 'annule') {
        // Simuler l'annulation - état 0
        if (!$scope.annuairetransporteurs.daoData) {
          $scope.annuairetransporteurs.daoData = {};
        }
        $scope.annuairetransporteurs.daoData.etat_publication = 0; // État annulé
        toastr.success('Annuaire annulé avec succès');
      }

      // Forcer la mise à jour de l'affichage
      if (!$scope.$$phase) {
        $scope.$apply();
      }
    };

    // Fonction pour mettre à jour les propriétés d'affichage de l'état
    function updateEtatBadgeAndText() {
      var etatConfig = {
        'brouillon': { badge: 'bg-primary', text: 'Brouillon' },
        'publie': { badge: 'bg-warning', text: 'Publié' },
        'cloture': { badge: 'bg-success', text: 'Clôturé' },
        'annule': { badge: 'bg-danger', text: 'Annulé' }
      };

      var config = etatConfig[$scope.annuairetransporteurs.etat] || { badge: 'bg-secondary', text: 'Inconnu' };

      // Mise à jour des propriétés pour l'affichage
      $scope.annuairetransporteurs.etat_badge = config.badge;
      $scope.annuairetransporteurs.etat_text = config.text;
    }

    // Initialisation des propriétés d'affichage au chargement
    if ($scope.annuairetransporteurs) {
      updateEtatBadgeAndText();
    }

    // Fonction pour sélectionner manuellement un lot
    $scope.selectArticleBC = function (lotId, index) {
      const article = $scope.commande.articles[index];
      const designation = article.designation;

      // Trouver le lot sélectionné
      const lotSelectionne = $scope.lotsDisponibles[designation].find(lot => lot.id === lotId);

      if (lotSelectionne) {
        article.lotSelectionne = lotSelectionne.id;
        article.peremption = lotSelectionne.peremption;
        article.prix = lotSelectionne.prix;

        // Déterminer la source en fonction du stock disponible
        if (lotSelectionne.stockAgence > 0) {
          article.source = 'agence';
          article.stockAgence = lotSelectionne.stockAgence;
          article.stockCentral = lotSelectionne.stockCentral;
        } else if (lotSelectionne.stockCentral > 0) {
          article.source = 'central';
          article.stockAgence = lotSelectionne.stockAgence;
          article.stockCentral = lotSelectionne.stockCentral;
        }

        $("#datepremption" + index).val(article.peremption).trigger('change');
        $scope.calculerTotal();
      }
    };

    // Fonctions pour la navigation
    $scope.setActiveStepTransport = function (step) {
      $scope.activeStepTransport = step;

      // Mettre à jour les classes des steps
      const steps = document.querySelectorAll('.stepper-item');
      steps.forEach((el, index) => {
        el.classList.remove('active', 'completed');
        if (index + 1 < step) {
          el.classList.add('completed');
        } else if (index + 1 === step) {
          el.classList.add('active');
        }
      });
    };
    $scope.getValidationStatusTextTransport = function (etat) {
      switch (etat) {
        case 'soumis': return 'Soumis';
        case 'resAchat': return 'Resp. Achat';
        case 'dirAchat': return 'Dir. Achat';
        case 'dg': return 'DG Validé';
        default: return 'Non soumis';
      }
    };

    $scope.soumettreAxesTonnagesTransport = function () {
      $scope.offretransportsaxes.validation.etat = 'soumis';
      $scope.offretransportsaxes.validation.dateSoumission = new Date();
      alert('Axes et tonnages soumis pour validation!');
    };

    $scope.soumettreDaoTransport = function () {
      $scope.offretransportsaxes.validationDao.etat = 'soumis';
      $scope.offretransportsaxes.validationDao.dateSoumission = new Date();
      alert('DAO Transport soumis pour validation!');
    };

    $scope.resAchatValidationTransport = function (section) {
      if (section === 'axes') {
        $scope.offretransportsaxes.validation.etat = 'resAchat';
        $scope.offretransportsaxes.validation.dateResAchat = new Date();
        alert('Axes validés par Responsable Achat!');
      } else if (section === 'dao') {
        $scope.offretransportsaxes.validationDao.etat = 'resAchat';
        $scope.offretransportsaxes.validationDao.dateResAchat = new Date();
        alert('DAO validé par Responsable Achat!');
      }
    };

    $scope.dirAchatValidationTransport = function (section) {
      if (section === 'axes') {
        $scope.offretransportsaxes.validation.etat = 'dirAchat';
        $scope.offretransportsaxes.validation.dateDirAchat = new Date();
        alert('Axes validés par Directeur Achat!');
      } else if (section === 'dao') {
        $scope.offretransportsaxes.validationDao.etat = 'dirAchat';
        $scope.offretransportsaxes.validationDao.dateDirAchat = new Date();
        alert('DAO validé par Directeur Achat!');
      }
    };

    $scope.dgValidationTransport = function (section) {
      if (section === 'axes') {
        $scope.offretransportsaxes.validation.etat = 'dg';
        $scope.offretransportsaxes.validation.dateDg = new Date();
        alert('Axes validés par DG!');
      } else if (section === 'dao') {
        $scope.offretransportsaxes.validationDao.etat = 'dg';
        $scope.offretransportsaxes.validationDao.dateDg = new Date();
        alert('DAO validé par DG!');
      }
    };

    // Vérification si toutes les validations sont complètes
    $scope.canSubmitTransportDao = function () {
      return $scope.offretransportsaxes.validation.etat === 'dg' &&
        $scope.offretransportsaxes.validationDao.etat === 'dg';
    };

    // Sauvegarde brouillon
    $scope.saveTransportDraft = function () {
      const draftData = {
        offretransportsaxes: $scope.offretransportsaxes,
        daoData: $scope.daoData
      };
      localStorage.setItem('transportDraft', JSON.stringify(draftData));
      alert('Brouillon enregistré avec succès!');
    };

    // Soumission finale
    $scope.submitDaoTransportFinal = function () {
      if (!$scope.canSubmitTransportDao || !$scope.canSubmitTransportDao()) {
        alert('Veuillez valider toutes les sections avant de soumettre');
        return;
      }

      if (!$scope.offretransportsaxes) {
        console.error('offretransportsaxes est undefined');
        alert('Erreur: Données de transport non chargées');
        return;
      }

      let gestionnaire = 'Non spécifié';
      if ($scope.getbesoin && typeof $scope.getbesoin === 'object' && $scope.getbesoin.gestionnaire) {
        gestionnaire = $scope.getbesoin.gestionnaire;
      }

      const transportData = {
        id: $scope.offretransportsaxes.id || Date.now(),
        designation: $scope.offretransportsaxes.designation || 'Offre de transport',
        offreId: $scope.offretransportsaxes.id || null,
        type: 'transport',
        date: new Date(),
        ref: 'TRP-' + Date.now(),
        gestionnaire: gestionnaire,

        axes: Array.isArray($scope.offretransportsaxes.axes) ? $scope.offretransportsaxes.axes : [],
        axesValidation: $scope.offretransportsaxes.validation || {},

        daoData: {
          modeles: $scope.daoData && $scope.daoData.modeles ? $scope.daoData.modeles : {},
          date_pub: $scope.daoData && $scope.daoData.date_pub ? $scope.daoData.date_pub : null,
          date_cloture: $scope.daoData && $scope.daoData.date_cloture ? $scope.daoData.date_cloture : null
        },
        daoValidation: $scope.offretransportsaxes.validationDao || {},

        status: 'validé',
        dateValidation: new Date()
      };

      $scope.dataPage.annuairetransporteurs.push(transportData);

      console.log('OBJET TRANSPORT FINAL:', transportData);
      console.log('Données de transport sauvegardées dans dataPage.annuairetransporteurs', $scope.dataPage.annuairetransporteurs);
      alert('Soumission finale effectuée avec succès!');

    };


    // Fonction utilitaire pour supprimer un axe
    $scope.removeAxe = function (index) {
      $scope.offretransportsaxes.axes.splice(index, 1);
      toastr.info('Axe supprimé');
    };

    // Fonction de filtrage
    $scope.searchFilter = function (item) {
      if (!$scope.searchtexte_list_article) return true;
      const searchText = $scope.searchtexte_list_article.toLowerCase();
      return item.axe.toLowerCase().includes(searchText);
    };



    // Fonction d'initialisation du suivi marché

    // Fonction d'initialisation du suivi marché
    // Fonction d'initialisation du suivi marché - CORRIGÉE
    $scope.initializeSuiviMarche = function () {
      console.log("Initialisation des données de suivi marché");

      // S'assurer que daoData.bc existe
      if (!$scope.daoData.bc) {
        $scope.daoData.bc = {
          date: new Date().toLocaleDateString(),
          ref: 'BC-' + Math.random().toString(36).substr(2, 9).toUpperCase(),
          fournisseur: 'Fournisseur à définir',
          arivages: [{
            date: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toLocaleDateString()
          }]
        };
      }

      // Initialiser les fournisseurs si non définis
      if (!$scope.daoData.suppliers || $scope.daoData.suppliers.length === 0) {
        $scope.daoData.suppliers = [{
          name: 'Fournisseur Principal',
          type: 'National',
          validated: true,
          dossierfournisseur: {
            soumissions: [],
            documentsFournis: {
              attestationFiscale: 'attestation_fiscale.pdf',
              extraitKbis: 'extrait_kbis.pdf'
            },
            documentsSpecifiques: {
              ordreTransit: 'ordre_transit.pdf',
              engagementLivraison: 'engagement_livraison.pdf'
            }
          }
        }];

        // TROUVER LES ARTICLES - plusieurs possibilités
        let articles = [];

        // Essayer différentes propriétés où les articles pourraient être stockés
        if ($scope.getTargetprice.articles) {
          articles = $scope.getTargetprice.articles;
          console.log('Articles trouvés dans .articles');
        } else if ($scope.getTargetprice.Articles) {
          articles = $scope.getTargetprice.Articles;
          console.log('Articles trouvés dans .Articles');
        } else if ($scope.getTargetprice.items) {
          articles = $scope.getTargetprice.items;
          console.log('Articles trouvés dans .items');
        } else if ($scope.getTargetprice.products) {
          articles = $scope.getTargetprice.products;
          console.log('Articles trouvés dans .products');
        } else {
          // Fallback: utiliser les articles du besoin
          articles = $scope.getbesoin.articles || [];
          console.log('Utilisation des articles du besoin comme fallback');
        }

        console.log('Articles à utiliser:', articles);

        // Ajouter des soumissions basées sur les articles trouvés
        articles.forEach((article, index) => {
          $scope.daoData.suppliers[0].dossierfournisseur.soumissions.push({
            articleId: article.id || index,
            articleData: angular.copy(article), // Stocker une copie des données de l'article
            conditionLivraison: 'DDP',
            delaiLivraison: '30 jours',
            datePeremption: new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toLocaleDateString(),
            qteCmd: article.quantite || article.quantity || 0,
            qteLiv: 0,
            statut: 'en_attente',
            approuve: false,
            motifRejet: ''
          });
        });
      }

      console.log('Données BC:', $scope.daoData.bc);
      console.log('Fournisseurs:', $scope.daoData.suppliers);
    };

    // Fonction pour récupérer un article par son ID - CORRIGÉE
    $scope.getArticleByIdPm = function (articleId) {
      console.log('Recherche article avec ID:', articleId);

      // Parcourir toutes les soumissions pour trouver l'article
      if ($scope.daoData.suppliers && $scope.daoData.suppliers.length > 0) {
        const soumission = $scope.daoData.suppliers[0].dossierfournisseur.soumissions.find(
          s => s.articleId === articleId || s.articleData.id === articleId
        );

        if (soumission && soumission.articleData) {
          console.log('Article trouvé dans soumission:', soumission.articleData);
          return soumission.articleData;
        }
      }

      // Fallback: chercher dans le target price
      if ($scope.getTargetprice) {
        const articles = $scope.getTargetprice.articles || $scope.getTargetprice.Articles || [];
        const article = articles.find(a => a.id === articleId);
        if (article) {
          console.log('Article trouvé dans target price:', article);
          return article;
        }
      }

      console.log('Article non trouvé, retour objet vide');
      return { designation: 'Article non trouvé', prixUnitaire: 0, quantite: 0 };
    };

    $scope.getArticleByIdTP = function (articleId) {
      if ($scope.getTargetprice && $scope.getTargetprice.articles) {
        return $scope.getTargetprice.articles.find(article => article.id === articleId) || {};
      }
      return {};
    };
    // Fonction pour confirmer le changement de statut
    $scope.confirmStatusChangeTp = function () {
      // Trouver la soumission originale et la mettre à jour
      if ($scope.daoData.suppliers && $scope.daoData.suppliers.length > 0) {
        const soumissionIndex = $scope.daoData.suppliers[0].dossierfournisseur.soumissions.findIndex(
          s => s.articleId === $scope.currentSoumission.articleId
        );

        if (soumissionIndex !== -1) {
          $scope.daoData.suppliers[0].dossierfournisseur.soumissions[soumissionIndex] =
            angular.copy($scope.currentSoumission);
        }
      }
    };





    // Ajouter cette fonction dans le contrôleur
    $scope.simulerDocument = function (typeDocument, supplier, isSpecifique = true) {
      // Générer un nom de fichier aléatoire
      const extensions = ['pdf', 'docx', 'xlsx', 'jpg'];
      const extension = extensions[Math.floor(Math.random() * extensions.length)];
      const nomFichier = `${typeDocument}_${supplier.name.replace(/\s+/g, '_')}_${Date.now()}.${extension}`;

      // Déterminer où stocker le document
      const docCollection = isSpecifique ?
        supplier.dossierfournisseur.documentsSpecifiques :
        supplier.dossierfournisseur.documentsFournis;

      // Créer le document simulé
      docCollection[typeDocument].fichier = {
        nom: nomFichier,
        url: `#${typeDocument}-${supplier.id}`,
        date: new Date().toLocaleDateString()
      };

      // Créer un lien de téléchargement
      const link = document.createElement('a');
      link.href = 'data:text/plain;charset=utf-8,' +
        encodeURIComponent(`Contenu simulé du document ${typeDocument} pour ${supplier.name}`);
      link.download = nomFichier;
      link.style.display = 'none';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    };
    // Fonction pour déterminer l'état de la livraison (noms modifiés)
    $scope.getSuiviLivraisonStatus = function () {
      if (!$scope.daoData.suppliers || $scope.daoData.suppliers.length === 0) {
        return 'en_attente';
      }

      const soumissions = $scope.daoData.suppliers[0].dossierfournisseur.soumissions;

      if (!soumissions || soumissions.length === 0) {
        return 'en_attente';
      }

      // Calculer les statistiques
      const totalSoumissions = soumissions.length;
      const approuvees = soumissions.filter(s => s.approuve).length;

      // Déterminer l'état global
      if (approuvees === totalSoumissions) {
        return 'complet';
      } else if (approuvees > 0 || soumissions.some(s => s.statut === 'accepté' || s.statut === 'relancé')) {
        return 'en_cours';
      } else {
        return 'en_attente';
      }
    };

    // Fonction pour obtenir le texte de l'état (noms modifiés)
    $scope.getSuiviLivraisonStatusText = function () {
      const status = $scope.getSuiviLivraisonStatus();

      switch (status) {
        case 'complet':
          return 'Complet';
        case 'en_cours':
          return 'En cours';
        case 'en_attente':
          return 'En attente';
        default:
          return 'Inconnu';
      }
    };
    // Variables spécifiques au suivi marché
    $scope.suiviMarcheAccordionOpen = true;
    $scope.suiviMarcheCurrentSoumission = null;

    // Fonction pour toggle l'accordéon
    $scope.suiviMarcheToggleAccordion = function () {
      $scope.suiviMarcheAccordionOpen = !$scope.suiviMarcheAccordionOpen;
    };

    // Fonction pour calculer l'état de livraison
    $scope.suiviMarcheCalculEtat = function () {
      if (!$scope.daoData.suppliers || $scope.daoData.suppliers.length === 0) {
        return 'en_attente';
      }

      const soumissions = $scope.daoData.suppliers[0].dossierfournisseur.soumissions;
      if (!soumissions || soumissions.length === 0) return 'en_attente';

      const total = soumissions.length;
      const approuvees = soumissions.filter(s => s.approuve).length;
      const rejetees = soumissions.filter(s => s.statut === 'rejeté').length;
      const enCours = soumissions.filter(s => s.statut === 'relancé' || s.statut === 'accepté').length;

      if (approuvees === total) return 'complet';
      if (rejetees === total) return 'rejeté';
      if (approuvees > 0 || enCours > 0) return 'en_cours';
      return 'en_attente';
    };

    // Fonction pour obtenir le texte de l'état
    $scope.suiviMarcheTexteEtat = function () {
      switch ($scope.suiviMarcheCalculEtat()) {
        case 'complet': return 'Complet';
        case 'en_cours': return 'En cours';
        case 'en_attente': return 'En attente';
        case 'rejeté': return 'Rejeté';
        default: return 'Inconnu';
      }
    };

    // Fonction pour ouvrir le modal
    $scope.suiviMarcheOuvrirModal = function (soumission) {
      if (soumission.statut === 'rejeté' || soumission.statut === 'relancé') {
        $scope.suiviMarcheCurrentSoumission = angular.copy(soumission);
        $('#suiviMarcheModalRejet').modal('show');
      }
    };

    // Fonction pour confirmer le changement de statut
    $scope.suiviMarcheConfirmerStatut = function () {
      if (!$scope.suiviMarcheCurrentSoumission.motifRejet) {
        alert('Veuillez saisir un motif');
        return;
      }

      if ($scope.daoData.suppliers && $scope.daoData.suppliers.length > 0) {
        const index = $scope.daoData.suppliers[0].dossierfournisseur.soumissions.findIndex(
          s => s.articleId === $scope.suiviMarcheCurrentSoumission.articleId
        );

        if (index !== -1) {
          $scope.daoData.suppliers[0].dossierfournisseur.soumissions[index] =
            angular.copy($scope.suiviMarcheCurrentSoumission);

          if ($scope.suiviMarcheCurrentSoumission.statut === 'rejeté') {
            $scope.daoData.suppliers[0].dossierfournisseur.soumissions[index].approuve = false;
          }
        }
      }

      $('#suiviMarcheModalRejet').modal('hide');
      $scope.suiviMarcheCurrentSoumission = null;
    };

    // Fonction pour mettre à jour l'approbation
    $scope.suiviMarcheMajApproval = function (soumission) {
      if (soumission.approuve) {
        soumission.statut = 'accepté';
        soumission.motifRejet = '';
      }
    };
    $scope.currentSoumission = null;

    $scope.openStatusModal = function (soumission) {
      $scope.currentSoumission = soumission;

      // Si c'est accepté, pas besoin de modal
      if (soumission.statut === 'accepté') {
        $scope.updateStatus(soumission);
        return;
      }

      $('#statusModal').modal('show');
    };
    // Dans la section d'initialisation
    $scope.bcValidation = {
      responsableAchat: false,
      dg: false
    };
    $scope.validationSeuilDG = 50000; // Seuil configurable

    // Méthodes à ajouter
    $scope.needDgValidation = function () {
      return $scope.getTotalSelected() > $scope.validationSeuilDG;
    };

    $scope.validateResponsableAchat = function () {
      $scope.bcValidation.responsableAchat = true;
      if (!$scope.needDgValidation()) {
        $scope.notifyValidationComplete();
      }
    };

    $scope.validateDG = function () {
      $scope.bcValidation.dg = true;
      $scope.notifyValidationComplete();
    };

    $scope.isBcValidated = function () {
      if ($scope.needDgValidation()) {
        return $scope.bcValidation.responsableAchat && $scope.bcValidation.dg;
      }
      return $scope.bcValidation.responsableAchat;
    };

    $scope.getTotalSelected = function () {
      return $scope.appelOffre.articles.reduce((total, article) => {
        return total + (article.prixUnitaire * article.quantite);
      }, 0);
    };

    $scope.confirmStatusChange = function () {
      if ($scope.currentSoumission) {
        $scope.updateStatus($scope.currentSoumission);
        $scope.saveDataStorage(); // Sauvegarde après modification

      }
    };

    $scope.updateStatus = function (soumission) {
      // Mettre à jour l'approbation
      soumission.approuve = soumission.statut === 'accepté';

      // Si rejet ou relance sans motif, mettre un motif par défaut
      if ((soumission.statut === 'rejeté' || soumission.statut === 'relancé') && !soumission.motifRejet) {
        soumission.motifRejet = 'Raison non spécifiée';
      }

      $scope.$applyAsync();
    };
    $scope.selectFinalSupplier = function (selectedSupplier) {
      // Désélectionner tous les autres fournisseurs
      $scope.appelOffre.daoData.suppliers.forEach(supplier => {
        if (supplier.id !== selectedSupplier.id) {
          supplier.selectedForFinal = false;
        }
      });

      // Valider automatiquement le fournisseur sélectionné
      selectedSupplier.validated = selectedSupplier.selectedForFinal;

      // Marquer tous ses articles comme approuvés
      if (selectedSupplier.selectedForFinal) {
        selectedSupplier.dossierfournisseur.soumissions.forEach(soumission => {
          soumission.approuve = true;
          soumission.statut = 'accepté';
        });
      }
    };
    $scope.countRejectedSubmissions = function (supplier) {
      return supplier.dossierfournisseur.soumissions.filter(s => s.statut === 'rejeté').length;
    };
    $scope.countApprovedSubmissions = function (supplier) {
      return supplier.dossierfournisseur.soumissions
        .filter(s => s.statut === 'accepté').length;
    };
    $scope.showRecapView = false; // Par défaut on affiche la vue détaillée
    $scope.activeProductIndex = 0; // Index du produit sélectionné

    $scope.getSupplierSubmission = function (supplier, articleId) {
      if (!supplier.dossierfournisseur || !supplier.dossierfournisseur.soumissions) {
        return {
          prixUnitaire: 'N/A',
          ecart: 0,
          conditionLivraison: 'N/A',
          delaiLivraison: 'N/A',
          datePeremption: 'N/A'
        };
      }

      const soumission = supplier.dossierfournisseur.soumissions.find(s => s.articleId === articleId);
      return soumission || {
        prixUnitaire: 'N/A',
        ecart: 0,
        conditionLivraison: 'N/A',
        delaiLivraison: 'N/A',
        datePeremption: 'N/A'
      };
    };

    // Dans votre contrôleur Angular
    $scope.getValidatedArticles = function () {
      console.log("getValidatedArticles() called");
      const validatedArticles = [];
      const seenArticleIds = new Set();

      // Vérifier si les données existent
      if (!$scope.dataPage['aos'] || !$scope.dataPage['aos'][0] || !$scope.dataPage['aos'][0].soumissions) {
        console.log("Data structure incomplete");
        return validatedArticles;
      }

      console.log("Number of suppliers:", $scope.dataPage['aos'][0].soumissions.length);

      // Parcourir tous les fournisseurs
      $scope.dataPage['aos'][0].soumissions.forEach(soumission => {
        console.log("soumission:", soumission.fournisseur?.nom, "Statut:", soumission.statut, "Type:", typeof soumission.statut);

        // Convertir statut en number pour la comparaison
        const soumissionStatut = parseInt(soumission.statut, 10);

        // Vérifier si le fournisseur est validé (statut = 1)
        if (soumissionStatut === 1) {
          console.log("soumission is validated");

          if (soumission.soumissionarticles) {
            console.log("Number of articles for this soumission:", soumission.soumissionarticles.length);

            // Parcourir les articles du fournisseur
            soumission.soumissionarticles.forEach(article => {
              console.log("Article:", article.article?.designation,
                "Result evaluation:", article.resultatevaluation,
                "Type:", typeof article.resultatevaluation);

              // Convertir resultatevaluation en number pour la comparaison
              const resultEvaluation = parseInt(article.resultatevaluation, 10);

              // Vérifier si l'article a resultatevaluation = 1 et n'a pas déjà été ajouté
              if (resultEvaluation === 1) {
                console.log("Article has resultatevaluation = 1 - ADDING TO LIST");

                if (!seenArticleIds.has(article.article.id)) {
                  console.log("Adding article to list:", article.article.designation);

                  // Ajouter l'article à la liste
                  validatedArticles.push({
                    id: article.article.id,
                    designation: article.article.designation,
                    code: article.article.code,
                    prixUnitaire: article.targetprice,
                    quantite: article.quantitepropose,
                    margeValeur: article.margeValeur || 0,
                    margePourcentage: article.margePourcentage || 0
                  });
                  seenArticleIds.add(article.article.id);
                }
              } else {
                console.log("Article does not have resultatevaluation = 1, value:", article.resultatevaluation);
              }
            });
          } else {
            console.log("No soumissionarticles for this soumission");
          }
        } else {
          console.log("soumission is not validated (statut ≠ 1), value:", soumission.statut);
        }
      });

      console.log("Final validated articles count:", validatedArticles.length);
      return validatedArticles;
    };

    // Récupère les fournisseurs validés pour un article spécifique
    $scope.getValidatedSuppliersForArticle = function (articleId) {
      const validatedSuppliers = [];

      if ($scope.dataPage['aos'] && $scope.dataPage['aos'][0] && $scope.dataPage['aos'][0].soumissions) {
        $scope.dataPage['aos'][0].soumissions.forEach(supplier => {
          // Vérifier si le fournisseur est validé (statut = 1) - utilisation de == pour gérer string et number
          if (supplier.statut == 1 && supplier.soumissionarticles) {
            // Chercher l'article spécifique dans les articles du fournisseur
            const articleSoumission = supplier.soumissionarticles.find(
              article => article.article.id == articleId && article.resultatevaluation == 1
            );

            if (articleSoumission) {
              // Ajouter le fournisseur à la liste
              validatedSuppliers.push({
                id: supplier.id,
                name: supplier.fournisseur ? supplier.fournisseur.nom : 'Non défini',
                type: supplier.type,
                evaluation: supplier.evaluation || { final_score: '0%' },
                // Ajouter les informations de soumission pour cet article
                soumissionArticle: articleSoumission
              });
            }
          }
        });
      }

      return validatedSuppliers;
    };


    $scope.validateSupplier = function (supplier) {
      // Compter les articles Accepté pour ce fournisseur
      $scope.getValidatedSuppliersForArticle(1);
      const acceptedArticlesCount = supplier.dossierfournisseur.soumissions.filter(
        s => s.technicalEvaluation && s.technicalEvaluation.decision === 'Accepté'
      ).length;


      // Vérifier si au moins un article est accepté
      if (acceptedArticlesCount === 0) {
        // Afficher un message d'erreur ou une alerte
        alert('Impossible de valider le fournisseur : aucun article n\'est accepté.');
        return; // Arrêter l'exécution de la fonction
      }

      // Basculer l'état de validation de l'accordéon
      supplier.accordionValidated = !supplier.accordionValidated;

      // Mettre à jour les soumissions validées (seulement celles acceptées)
      supplier.dossierfournisseur.soumissions.forEach(s => {
        if (s.technicalEvaluation && s.technicalEvaluation.decision === 'Accepté') {
          s.accordionValidated = supplier.accordionValidated;
        } else {
          // S'assurer que les articles non acceptés ne sont pas marqués comme validés
          s.accordionValidated = false;
        }
      });

      $scope.saveDataStorage(); // Sauvegarde après modification
    };
    // Récupère les articles validés (au moins un fournisseur validé pour cet article)



    // Récupère l'article actif
    $scope.getActiveArticle = function () {
      return $scope.appelOffre.articles[$scope.activeProductIndex];
    };



    $scope.setActiveProductIndex = function (index) {
      $scope.activeProductIndex = index;
    };
    // Fonction pour obtenir la soumission d'un article spécifique
    $scope.getSoumissionForArticle = function (supplier, articleId) {
      // Retourner directement l'article de soumission depuis l'objet supplier
      return supplier.soumissionArticle || {};
    };
    $scope.getSupplierScore = function (articleId) {
      return function (supplier) {
        const soumission = $scope.getSoumissionForArticle(supplier, articleId);
        if (!soumission) return 0;

        // Logique de scoring basée sur le prix (plus bas = mieux)
        return soumission.prixUnitaire || 0;
      };
    };
    $scope.exportToPDF = function () {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF('l', 'pt');

      // Préparer les données pour le PDF
      const headers = [
        ['Choix', 'Classement', 'Fournisseur', 'Score', 'Cond. Salama',
          'Cond. Fournisseur', 'Prix proposé', 'Target price', 'Marge',
          'Qte demandée', 'Qte proposée', 'Ecart', 'Total']
      ];

      const data = $scope.activeArticleSuppliers.map((supplier, index) => {
        // Déterminer le classement
        let classement = '1er';
        if (!supplier.isSelected && supplier.ranking) {
          classement = supplier.ranking + 'ème';
        } else if (!supplier.isSelected) {
          classement = (index + 1) + 'ème';
        }

        return [
          supplier.isSelected ? '✓' : '-',
          classement,
          supplier.nom + (supplier.isSelected ? ' (Sélectionné)' : ''),
          supplier.score || '0%',
          'CDP',
          supplier.type || 'DDP',
          $filter('number')(supplier.prix, 2),
          $filter('number')(supplier.targetprice, 2),
          $filter('number')(supplier.marge, 2),
          supplier.quantitedemande,
          $filter('number')(supplier.quantite, 0),
          supplier.ecart,
          $filter('number')((supplier.prix * supplier.quantite), 2)
        ];
      });

      // Générer le PDF
      doc.autoTable({
        head: headers,
        body: data,
        theme: 'grid',
        headStyles: {
          fillColor: [58, 83, 155],
          textColor: 255,
          fontStyle: 'bold',
          textAlign: 'center'
        },
        styles: {
          fontSize: 7,
          cellPadding: 2,
          overflow: 'linebreak',
          textAlign: 'center'
        },
        margin: { top: 40 },
        didDrawPage: function (data) {
          // En-tête
          doc.setFontSize(16);
          doc.setTextColor(40);
          doc.text('Liste des fournisseurs - ' + $scope.appelOffre.reference,
            data.settings.margin.left, 20);

          // Sous-titre avec l'article
          doc.setFontSize(12);
          doc.text('Article: ' + $scope.activeArticle.designation,
            data.settings.margin.left, 35);

          // Date d'export
          doc.setFontSize(10);
          doc.text('Exporté le: ' + new Date().toLocaleDateString(),
            data.settings.margin.left, 50);
        }
      });

      doc.save('fournisseurs_' + $scope.appelOffre.reference + '_' + $scope.activeArticle.designation + '.pdf');
    };
    $scope.getSortedSuppliers = function () {
      return $filter('orderBy')($scope.activeArticleSuppliers, ['-isSelected', 'ranking']);
    };


    $scope.exportToExcel = function () {
      const table = document.getElementById('suppliersTable');
      const ws = XLSX.utils.table_to_sheet(table);

      // Ajustement des largeurs de colonnes
      const wscols = [
        { wch: 10 }, { wch: 25 }, { wch: 15 },
        { wch: 15 }, { wch: 15 }, { wch: 15 },
        { wch: 15 }, { wch: 15 }, { wch: 15 }
      ];
      ws['!cols'] = wscols;

      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, "Fournisseurs");

      XLSX.writeFile(wb, 'fournisseurs_' + $scope.appelOffre.reference + '.xlsx');
    };
    $scope.calculateGap = function (soumission) {
      const article = $scope.getArticleById(soumission.articleId);
      if (soumission.prixUnitaire && article.prixUnitaire) {
        soumission.ecart = ((soumission.prixUnitaire - article.prixUnitaire) / article.prixUnitaire * 100).toFixed(2);
      } else {
        soumission.ecart = 0;
      }
      $scope.saveDataStorage(); // Sauvegarde après modification

    };
    $scope.downloadFile = function (filename) {
      // Créer un contenu factice pour le fichier
      const content = `Contenu simulé du fichier ${filename}`;
      const blob = new Blob([content], { type: 'text/plain' });

      // Créer un lien de téléchargement
      const link = document.createElement('a');
      link.href = window.URL.createObjectURL(blob);
      link.download = filename;
      link.style.display = 'none';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      window.URL.revokeObjectURL(link.href);
    };

    $scope.pharmaSections = [
      {
        title: "ÉVALUATION ADMINISTRATIVE",
        subtitle: "DOCUMENTS ADMINISTRATIFS",
        decision: "Favorable",
        criteres: [
          { text: "Demande d'inscription dûment remplie et signée", value: "oui", remarques: "" },
          { text: "Copie de l'autorisation de mise sur le marché (AMM) en cours de validité", value: "oui", remarques: "" },
          { text: "Copie du certificat de produit pharmaceutique (CPP) en cours de validité", value: "oui", remarques: "" },
          { text: "Document justificatif du prix de vente au public (PVP)", value: "oui", remarques: "" },
          { text: "Copie de l'autorisation d'importation le cas échéant", value: "non", remarques: "Non requis pour ce produit" }
        ]
      },
      {
        title: "ÉVALUATION DE LA QUALITÉ",
        subtitle: "DOCUMENTATION QUALITÉ",
        decision: "Favorable",
        criteres: [
          { text: "Spécifications du produit fini", value: "oui", remarques: "" },
          { text: "Certificat d'analyse du produit fini (lot proposé)", value: "oui", remarques: "" },
          { text: "Notice d'utilisation et conditionnement proposé", value: "oui", remarques: "" },
          { text: "Stabilité du produit (étude ou données disponibles)", value: "oui", remarques: "Données de stabilité complètes fournies" },
          { text: "Rapport d'inspection du site de fabrication (si disponible)", value: "non", remarques: "En attente de transmission" }
        ]
      },
      {
        title: "ÉVALUATION DE L'ÉCHANTILLON",
        subtitle: "CONTRÔLE PHYSIQUE DE L'ÉCHANTILLON",
        decision: "Favorable",
        criteres: [
          { text: "Correspondance DCI/dosage/forme", value: "oui", remarques: "" },
          { text: "Aspect conforme (couleur, forme, texture)", value: "oui", remarques: "" },
          { text: "Emballage primaire intact et adapté", value: "oui", remarques: "" },
          { text: "Étiquetage conforme (libellé, informations réglementaires)", value: "oui", remarques: "Étiquetage en français conforme" },
          { text: "Absence de défauts apparents", value: "oui", remarques: "" }
        ]
      }
    ];

    $scope.initializeProposedPrices = function () {
      if (!$scope.appelOffre || !$scope.appelOffre.articles) {
        console.error("Aucun appel d'offre ou articles disponibles");
        return;
      }

      // Initialisation spécifique pour cette vue
      $scope.openSupplierIndex = -1;

      // Initialiser la date courante
      $scope.currentDate = new Date();

      // Gestion des fournisseurs internationaux
      if ($scope.appelOffre.typefounisseur === 'International') {
        $scope.appelOffre.daoData.suppliers.forEach(supplier => {
          if (supplier.dossierfournisseur && supplier.dossierfournisseur.soumissions) {
            supplier.dossierfournisseur.soumissions.forEach(s => {
              s.documents = s.documents || {
                ordreTransit: null,
                transitaire: null,
                cabinetExpertise: null,
                domiciliationFacture: null,
                MIDAC: null
              };
            });
          }
        });
      }

      $scope.appelOffre.daoData.suppliers.forEach(supplier => {
        const isInternational = supplier.type === 'Internationnal';
        supplier.selectedForFinal = supplier.selectedForFinal || false;
        supplier.accordionValidated = supplier.accordionValidated || false;

        // Générer des valeurs aléatoires pour délai et péremption
        const randomDeliveryDays = Math.floor(Math.random() * 30) + 5; // 5-35 jours
        const randomExpiryDays = Math.floor(Math.random() * 365) + 180; // 6 mois-1.5 ans
        const randomLot = "LOT" + Math.floor(Math.random() * 10000);
        const randomDate = new Date(Date.now() - Math.floor(Math.random() * 30) * 24 * 60 * 60 * 1000);

        supplier.delaiLivraison = `${randomDeliveryDays} jours`;
        supplier.datePeremption = new Date(Date.now() + randomExpiryDays * 24 * 60 * 60 * 1000);
        supplier.datearrivage = randomDate;
        // Générer des fichiers aléatoires pour la démo
        const generateFile = (prefix) => {
          const extensions = ['pdf', 'docx', 'xlsx', 'jpg'];
          const ext = extensions[Math.floor(Math.random() * extensions.length)];
          return Math.random() > 0.3 ? `${prefix}_${supplier.name.replace(/\s+/g, '_')}_${Date.now()}.${ext}` : null;
        };

        // Générer des données d'évaluation fournisseur fictives
        supplier.evaluation = supplier.evaluation || {
          date: new Date(),
          evaluation_number: 'EVAL-' + Math.floor(Math.random() * 1000),
          evaluator_appro_name: '',
          evaluator_appro_function: '',
          evaluator_quality_name: '',
          evaluator_quality_function: '',
          evaluated_market: $scope.appelOffre.reference,
          company_address: '',
          company_phone: '',
          company_email: '',
          manager_name: '',
          manager_email: '',
          contact_name: '',
          contact_position: '',
          contact_email: '',
          product_types: '',
          production_status: isInternational ? 'Fabricant' : 'Grossiste',
          note1: 0,
          note2: 0,
          note3: 0,
          note4: 0,
          note5: 0,
          note6: 0,
          total_notes: 0,
          total_weighted: 0,
          final_score: '0%',
          qualification: 'NON SATISFAISANT',
          mesures: 'AVERTISSEMENTS',
          signature_appro: '',
          signature_quality: '',
          signature_supply: '',
          signature_pharmacist: '',
          signature_director: ''
        };

        // Initialiser le dossier fournisseur
        supplier.dossierfournisseur = supplier.dossierfournisseur || {};
        supplier.dossierfournisseur.soumissions = $scope.appelOffre.articles.map(article => {
          const prixPropose = Math.round(article.prixUnitaire * (0.8 + Math.random() * 0.4));

          // Générer des données d'évaluation technique pour chaque article
          const technicalEvaluation = {
            autorisationExercice: $scope.getRandomScore(0, 5),
            certificatIsoCe: $scope.getRandomScore(0, 5),
            lettreAgrement: $scope.getRandomScore(0, 4),
            lettreSoumission: $scope.getRandomScore(0, 14),
            rcStatNifCp: $scope.getRandomScore(0, 10),
            attestationFiscale: $scope.getRandomScore(0, 16),
            presentationOffre: $scope.getRandomScore(0, 30),
            reclamationsQualite: $scope.getRandomScore(0, 10),
            ficheProduit: $scope.getRandomScore(0, 10),
            presenceAbsence: $scope.getRandomScore(0, 76),
            nonConformiteAveree: $scope.getRandomScore(0, 10),
            nonConformiteFiche: $scope.getRandomScore(0, 10),
            aspectDeteriore: $scope.getRandomScore(0, 100),
            conditionnement: $scope.getRandomScore(0, 5),
            etiquetage: $scope.getRandomScore(0, 5),
            fonctionnalites: $scope.getRandomScore(0, 5),
            caracteristiques: $scope.getRandomScore(0, 5),
            totalPoints: 0,
            observations: 'Conforme aux spécifications',
            decision: Math.random() > 0.3 ? 'Accepté' : 'En attente'
          };

          // Calculer le total des points immédiatement
          technicalEvaluation.totalPoints = Object.keys(technicalEvaluation)
            .filter(key => key !== 'totalPoints' && key !== 'observations' && key !== 'decision')
            .reduce((sum, key) => sum + (technicalEvaluation[key] || 0), 0);

          return {
            articleId: article.id,
            prixUnitaire: prixPropose,
            conditionLivraison: 'DDP',
            statut: 'en_attente',
            approuve: false,
            ecart: ((prixPropose - article.prixUnitaire) / article.prixUnitaire * 100).toFixed(2),
            motifRejet: null,
            delaiLivraison: `${randomDeliveryDays + Math.floor(Math.random() * 10)} jours`,
            datePeremption: new Date(Date.now() + (randomExpiryDays + Math.floor(Math.random() * 60)) * 24 * 60 * 60 * 1000),
            technicalEvaluation: technicalEvaluation
          };
        });



        // Initialiser les documents
        supplier.dossierfournisseur.documentsFournis = supplier.dossierfournisseur.documentsFournis || {
          attestationFiscale: generateFile('attestationFiscale'),
          extraitKbis: generateFile('extraitKbis'),
          referencesClients: generateFile('referencesClients'),
          certificatQualification: generateFile('certificatQualification')
        };

        supplier.dossierfournisseur.documentsSpecifiques = supplier.dossierfournisseur.documentsSpecifiques || (isInternational ? {
          ordreTransit: generateFile('ordreTransit'),
          transitaire: generateFile('transitaire'),
          cabinetExpertise: generateFile('cabinetExpertise'),
          domiciliationFacture: generateFile('domiciliationFacture'),
          MIDAC: generateFile('MIDAC')
        } : {
          certificatConformite: generateFile('certificatConformite'),
          engagementLivraison: generateFile('engagementLivraison')
        });

        // Initialiser l'évaluation pharmaceutique avec des objets Date
        supplier.pharmaEvaluation = supplier.pharmaEvaluation || {
          date: randomDate,
          evaluateurs: "Dr. Pharmacien Évaluateur, Dr. Clinicien",
          num_demande: "PHARM-" + Math.floor(1000 + Math.random() * 9000),
          date_demande: new Date(Date.now() - Math.floor(Math.random() * 60) * 24 * 60 * 60 * 1000),
          nom_commercial: supplier.name + " Pharma",
          dci: "DCI-" + Math.floor(10 + Math.random() * 90),
          dosage: (50 + Math.floor(Math.random() * 950)) + " mg",
          forme: ["Comprimé", "Gélule", "Solution", "Poudre"][Math.floor(Math.random() * 4)],
          conditionnement: (10 + Math.floor(Math.random() * 90)) + " unités par boîte",
          num_lot: randomLot,
          date_fabrication: new Date(Date.now() - (randomExpiryDays + 180) * 24 * 60 * 60 * 1000),
          date_peremption: new Date(Date.now() + randomExpiryDays * 24 * 60 * 60 * 1000),
          precautions_conservation: "Conserver à température ambiante (15-25°C). À l'abri de l'humidité et de la lumière.",
          specialite_reference: "Référence Médicament " + Math.floor(1 + Math.random() * 9),
          fabricant_produit: supplier.name + " Laboratories",
          titulaire_amm: supplier.name + " Pharma International",
          avis_admin: "Dossier administratif complet et conforme aux exigences réglementaires.",
          avis_clinique: "Produit présentant un profil efficacité/tolérance satisfaisant pour l'usage prévu.",
          avis_qualite: "Spécifications conformes à la pharmacopée. Contrôles qualité satisfaisants.",
          decision_finale: Math.random() > 0.2 ? "Favorable" : "Différé",
          valide_par: "Dr. Responsable Pharmacie",
          signature: "Cachet et signature du responsable",
          evaluateur_admin: "Dr. Évaluateur Administratif",
          evaluateur_qualite: "Dr. Évaluateur Qualité",
          evaluateur_clinique: "Dr. Évaluateur Clinique",
          representant_salama: "Représentant SALAMA"
        };

        // Convertir les dates existantes en objets Date si elles sont des strings
        if (supplier.pharmaEvaluation.date && typeof supplier.pharmaEvaluation.date === 'string') {
          supplier.pharmaEvaluation.date = new Date(supplier.pharmaEvaluation.date);
        }
        if (supplier.pharmaEvaluation.date_demande && typeof supplier.pharmaEvaluation.date_demande === 'string') {
          supplier.pharmaEvaluation.date_demande = new Date(supplier.pharmaEvaluation.date_demande);
        }
        if (supplier.pharmaEvaluation.date_fabrication && typeof supplier.pharmaEvaluation.date_fabrication === 'string') {
          supplier.pharmaEvaluation.date_fabrication = new Date(supplier.pharmaEvaluation.date_fabrication);
        }
        if (supplier.pharmaEvaluation.date_peremption && typeof supplier.pharmaEvaluation.date_peremption === 'string') {
          supplier.pharmaEvaluation.date_peremption = new Date(supplier.pharmaEvaluation.date_peremption);
        }

        $scope.activeProductIndex = 0;

        // S'assurer que toutes les propriétés existent
        supplier.dossierfournisseur.soumissions.forEach(soumission => {
          soumission.approuve = soumission.approuve || false;
          soumission.selectedForArticle = soumission.selectedForArticle || false;
          soumission.technicalEvaluation = soumission.technicalEvaluation || {
            autorisationExercice: 0,
            certificatIsoCe: 0,
            lettreAgrement: 0,
            lettreSoumission: 0,
            rcStatNifCp: 0,
            attestationFiscale: 0,
            presentationOffre: 0,
            reclamationsQualite: 0,
            ficheProduit: 0,
            presenceAbsence: 0,
            nonConformiteAveree: 0,
            nonConformiteFiche: 0,
            aspectDeteriore: 0,
            conditionnement: 0,
            etiquetage: 0,
            fonctionnalites: 0,
            caracteristiques: 0,
            totalPoints: 0,
            observations: 'Conforme aux spécifications',
            decision: 'En attente'
          };

          // Convertir la date en objet Date si c'est une string
          if (soumission.datePeremption && typeof soumission.datePeremption === 'string') {
            soumission.datePeremption = new Date(soumission.datePeremption);
          }
        });
      });


      $scope.appelOffre.daoData.suppliers.forEach(supplier => {
        supplier.dossierfournisseur.soumissions.forEach(soumission => {
          // Initialiser les nouveaux champs avec des valeurs par défaut
          soumission.paysFabrication = soumission.paysFabrication || "France";
          soumission.preQualification = soumission.preQualification || "OUI";
          soumission.statutAMM = soumission.statutAMM || "OUI";
          soumission.presenceEchantillon = soumission.presenceEchantillon || "NA";
          soumission.presenceDossiersTech = soumission.presenceDossiersTech || "NA";
          soumission.observationsAQ = soumission.observationsAQ || "-";
          soumission.resultatEvaluation = soumission.resultatEvaluation || "NA";
        });
      });

      // Initialiser les sections pharmaSections avec des valeurs aléatoires
      if ($scope.pharmaSections && $scope.pharmaSections.length > 0) {
        $scope.pharmaSections.forEach(section => {
          section.criteres.forEach(critere => {
            // Pour la démo, la plupart des critères sont validés (80% de chance)
            critere.value = Math.random() > 0.2 ? "oui" : "non";

            // Ajouter des remarques aléatoires pour les cas négatifs
            if (critere.value === "non") {
              critere.remarques = "Document manquant ou incomplet. Nécessite un complément.";
            } else {
              critere.remarques = "Conforme aux exigences.";
            }
          });

          // Définir une décision aléatoire pour chaque section (principalement favorable)
          const rand = Math.random();
          if (rand > 0.8) {
            section.decision = "Défavorable";
          } else if (rand > 0.6) {
            section.decision = "Différé";
          } else {
            section.decision = "Favorable";
          }
        });
      }
      $scope.initializeExpeditionData();
      // Sauvegarder immédiatement dans localStorage
      $scope.saveDataStorage();
    };


    $scope.saveTechnicalEvaluation = function (supplier) {
      console.log("Évaluation technique sauvegardée pour:", supplier);

      // Vérifier s'il y a des articles à sauvegarder
      if (!supplier.soumissionarticles || supplier.soumissionarticles.length === 0) {
        $scope.showToast("Aucun article à sauvegarder", "warning", "Avertissement");
        return;
      }

      // Préparer les données à envoyer - un tableau d'articles
      const articlesData = supplier.soumissionarticles.map(article => {
        // Convertir les valeurs string en integer si nécessaire
        const convertToInt = (value) => {
          if (value === null || value === undefined) return null; // Retourner null au lieu de 0
          if (typeof value === 'string') {
            const parsed = parseInt(value, 10);
            return isNaN(parsed) ? null : parsed;
          }
          return value;
        };

        // Pour pays_id, on veut null si non défini, pas 0
        const getPaysId = () => {
          if (article.pays_id !== null && article.pays_id !== undefined && article.pays_id !== 0) {
            return article.pays_id;
          }
          if (supplier.pays_id !== null && supplier.pays_id !== undefined && supplier.pays_id !== 0) {
            return supplier.pays_id;
          }
          return null; // Retourner null si aucun pays n'est défini
        };

        return {
          id: article.id,
          typecondition_id: convertToInt(article.typecondition_id),
          prequalification: convertToInt(article.prequalification),
          statutamm: convertToInt(article.statutamm),
          presenceechantillon: convertToInt(article.presenceechantillon),
          presencedossierstech: convertToInt(article.presencedossierstech),
          observationsaq: article.observationsaq || '',
          resultatevaluation: convertToInt(article.resultatevaluation),
          pays_id: getPaysId() // Utiliser la fonction spéciale pour pays_id
        };
      });

      // Utiliser addElementWithoutForm pour envoyer les données
      $scope.addElementWithoutForm(
        {
          articles: articlesData,
          action: 'save-technical-evaluation'
        },
        'save_technical_evaluation',
        {
          from: "technical-evaluation",
          is_file_excel: false
        }
      );
    };


    // Fonction calculateTotalPoints sécurisée
    $scope.calculateTotalPoints = function (supplier) {
      if (!supplier.dossierfournisseur || !supplier.dossierfournisseur.soumissions) {
        console.error("Données de soumission manquantes");
        return;
      }

      supplier.dossierfournisseur.soumissions.forEach(soumission => {
        // S'assurer que technicalEvaluation existe
        if (!soumission.technicalEvaluation) {
          soumission.technicalEvaluation = {
            autorisationExercice: 0,
            certificatIsoCe: 0,
            lettreAgrement: 0,
            lettreSoumission: 0,
            rcStatNifCp: 0,
            attestationFiscale: 0,
            presentationOffre: 0,
            reclamationsQualite: 0,
            ficheProduit: 0,
            presenceAbsence: 0,
            nonConformiteAveree: 0,
            nonConformiteFiche: 0,
            aspectDeteriore: 0,
            conditionnement: 0,
            etiquetage: 0,
            fonctionnalites: 0,
            caracteristiques: 0,
            totalPoints: 0,
            observations: 'Conforme aux spécifications',
            decision: 'En attente'
          };
        }

        const te = soumission.technicalEvaluation;
        te.totalPoints =
          (te.autorisationExercice || 0) +
          (te.certificatIsoCe || 0) +
          (te.lettreAgrement || 0) +
          (te.lettreSoumission || 0) +
          (te.rcStatNifCp || 0) +
          (te.attestationFiscale || 0) +
          (te.presentationOffre || 0) +
          (te.reclamationsQualite || 0) +
          (te.ficheProduit || 0) +
          (te.presenceAbsence || 0) +
          (te.nonConformiteAveree || 0) +
          (te.nonConformiteFiche || 0) +
          (te.aspectDeteriore || 0) +
          (te.conditionnement || 0) +
          (te.etiquetage || 0) +
          (te.fonctionnalites || 0) +
          (te.caracteristiques || 0);
      });

      // Sauvegarder les modifications
      $scope.saveDataStorage();
    };

    // Fonction utilitaire pour getRandomScore (si elle n'existe pas déjà)
    $scope.getRandomScore = function (min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    };


    $scope.currentYear = new Date().getFullYear();
    $scope.evaluation = {

    };


    $scope.loadExistingEvaluation = function () {
      console.log("test ng-change");
      $scope.selectedannee = $("#annee_evaluation").val();
      console.log($scope.id, $scope.selectedannee);
      if (!$scope.selectedannee && !$scope.dataPage['fournisseurs'][0]) {
        return;
      }
      $scope.getelements(
        "evaluationsfournisseurs",
        null,
        (filtres = "fournisseur_id:" + $scope.id + ",annee:" + $scope.selectedannee),
      );

      $scope.getelements(
        "ficheevaluations",
        null,
        (filtres = `isactive:1,TSSCOD_0_0:"${$scope.dataPage['fournisseurs'][0].TSSCOD_0_0}"`),
      );

    }

    // Fonction pour mettre à jour une note d'évaluation
    $scope.updateEvaluationNote = function (fichecritereId, note) {
      if (!$scope.dataPage['evaluationsfournisseurs'] || $scope.dataPage['evaluationsfournisseurs'].length === 0) {
        return;
      }

      let evalData = $scope.dataPage['evaluationsfournisseurs'][0];

      // Initialiser noteevaluations si nécessaire
      if (!evalData.noteevaluations) {
        evalData.noteevaluations = [];
      }

      // Rechercher si la note existe déjà
      var existingNoteIndex = evalData.noteevaluations.findIndex(function (ne) {
        return parseInt(ne.fichecritere_id) === parseInt(fichecritereId);
      });

      if (existingNoteIndex !== -1) {
        // Mettre à jour la note existante
        evalData.noteevaluations[existingNoteIndex].note = parseFloat(note) || 0;
      } else {
        // Ajouter une nouvelle note
        evalData.noteevaluations.push({
          fichecritere_id: parseInt(fichecritereId),
          note: parseFloat(note) || 0
        });
      }

      // Recalculer l'évaluation
      $scope.calculateEvaluation();
    };

    // Calculer l'évaluation
    $scope.calculateEvaluation = function () {
      if (!$scope.dataPage['evaluationsfournisseurs'] || $scope.dataPage['evaluationsfournisseurs'].length === 0) {
        return;
      }

      let evalData = $scope.dataPage['evaluationsfournisseurs'][0];

      // Calculer le total pondéré
      const totalPondere = $scope.getTotalPondere();

      // Calculer le score maximum possible
      let maxScorePossible = 0;
      if ($scope.dataPage['ficheevaluations'] && $scope.dataPage['ficheevaluations'][0] && $scope.dataPage['ficheevaluations'][0].fichecriteres) {
        maxScorePossible = $scope.dataPage['ficheevaluations'][0].fichecriteres.reduce(function (total, evaluation) {
          return total + (parseFloat(evaluation?.critere?.points) || 0) * (parseFloat(evaluation.ponderation) || 0);
        }, 0);
      }

      // Conversion en pourcentage (sur 100)
      const finalScore = maxScorePossible > 0 ? (totalPondere / maxScorePossible) * 100 : 0;
      evalData.finalscore = finalScore.toFixed(2) + '%';

      // Détermination de la qualification
      if (finalScore >= 80) {
        evalData.qualification = 'SATISFAISANT';
      } else if (finalScore >= 60) {
        evalData.qualification = 'MOYENNEMENT SATISFAISANT';
      } else {
        evalData.qualification = 'NON SATISFAISANT';
      }

      // Mettre à jour les totaux
      evalData.totalnotes = $scope.getTotalNotes();
      evalData.totalweighted = totalPondere;
    };


    $scope.getNoteFournisseur = function (fichecritereId) {
      if (!$scope.dataPage['evaluationsfournisseurs'] ||
        !$scope.dataPage['evaluationsfournisseurs'][0] ||
        !$scope.dataPage['evaluationsfournisseurs'][0].noteevaluations) {
        return 0;
      }

      // Rechercher la note correspondant au fichecritere_id
      var noteEvaluation = $scope.dataPage['evaluationsfournisseurs'][0].noteevaluations.find(function (ne) {
        return parseInt(ne.fichecritere_id) === parseInt(fichecritereId);
      });

      return noteEvaluation ? parseFloat(noteEvaluation.note) : 0;
    };

    // Calculer le total des notes
    $scope.getTotalNotes = function () {
      if (!$scope.dataPage['evaluationsfournisseurs'] ||
        $scope.dataPage['evaluationsfournisseurs'].length === 0 ||
        !$scope.dataPage['evaluationsfournisseurs'][0].noteevaluations) {
        return 0;
      }

      let evalData = $scope.dataPage['evaluationsfournisseurs'][0];

      // Calculer la somme de toutes les notes
      return evalData.noteevaluations.reduce(function (total, noteEvaluation) {
        return total + (parseFloat(noteEvaluation.note) || 0);
      }, 0);
    };

    // Calculer le total de pondération
    $scope.getTotalPonderation = function () {
      if (!$scope.dataPage['ficheevaluations'] ||
        !$scope.dataPage['ficheevaluations'][0] ||
        !$scope.dataPage['ficheevaluations'][0].fichecriteres) {
        return 0;
      }

      // Calculer la somme de toutes les pondérations
      return $scope.dataPage['ficheevaluations'][0].fichecriteres.reduce(function (total, evaluation) {
        return total + (parseFloat(evaluation.ponderation) || 0);
      }, 0);
    };

    // Calculer le total pondéré
    $scope.getTotalPondere = function () {
      if (!$scope.dataPage['evaluationsfournisseurs'] ||
        $scope.dataPage['evaluationsfournisseurs'].length === 0 ||
        !$scope.dataPage['evaluationsfournisseurs'][0].noteevaluations ||
        !$scope.dataPage['ficheevaluations'] ||
        !$scope.dataPage['ficheevaluations'][0] ||
        !$scope.dataPage['ficheevaluations'][0].fichecriteres) {
        return 0;
      }

      let evalData = $scope.dataPage['evaluationsfournisseurs'][0];
      let totalPondere = 0;

      // Pour chaque note d'évaluation, trouver la pondération correspondante
      evalData.noteevaluations.forEach(function (noteEvaluation) {
        // Trouver le critère correspondant
        var critere = $scope.dataPage['ficheevaluations'][0].fichecriteres.find(function (fc) {
          return parseInt(fc.id) === parseInt(noteEvaluation.fichecritere_id);
        });

        if (critere) {
          totalPondere += (parseFloat(noteEvaluation.note) || 0) * (parseFloat(critere.ponderation) || 0);
        }
      });

      return totalPondere;
    };

    $scope.$watch('dataPage["evaluationsfournisseurs"][0]', function () {
      if ($scope.dataPage['evaluationsfournisseurs'] && $scope.dataPage['evaluationsfournisseurs'].length > 0) {
        $scope.calculateEvaluation();
      }
    });

    // Surveiller les changements sur les deux tableaux de données
    $scope.$watchGroup([
      'dataPage["evaluationsfournisseurs"]',
      'dataPage["ficheevaluations"]'
    ], function (newValues, oldValues) {
      if ($scope.dataPage['evaluationsfournisseurs'] &&
        $scope.dataPage['evaluationsfournisseurs'].length > 0 &&
        $scope.dataPage['ficheevaluations'] &&
        $scope.dataPage['ficheevaluations'].length > 0) {
        $scope.calculateEvaluation();
      }
    });




    $scope.generatePurchaseOrder = function (supplier) {
      try {
        supplier.bcGenerated = true;
        supplier.bcNumber = 'BC-' + new Date().getFullYear() + '-' + Math.floor(1000 + Math.random() * 9000);
        // Récupérer les articles sélectionnés
        const selectedArticles = supplier.dossierfournisseur.soumissions
          .filter(s => s.selectedForArticle)
          .map(s => {
            const article = $scope.getArticleById(s.articleId);
            return {
              designation: article.designation,
              quantity: article.quantite,
              unitPrice: s.prixUnitaire,
              deliveryCondition: s.conditionLivraison,
              deliveryTime: s.delaiLivraison
            };
          });

        // Vérification des données
        if (!selectedArticles.length) {
          throw new Error("Aucun article sélectionné pour ce fournisseur");
        }

        // Données du bon de commande
        const purchaseOrder = {
          reference: 'BC-' + $scope.appelOffre.reference + '-' + supplier.id + '-' + new Date().getTime(),
          supplier: {
            name: supplier.name || 'Non spécifié',
            address: supplier.address || 'Non spécifié',
            contact: supplier.contact || 'Non spécifié'
          },
          date: new Date().toLocaleDateString('fr-FR'),
          articles: selectedArticles,
          totalAmount: selectedArticles.reduce((sum, item) => sum + (item.unitPrice * item.quantity), 0)
        };

        // Initialisation de jsPDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Configuration
        const margin = 14;
        let yPos = 20;

        // Fonction sécurisée pour ajouter du texte
        const addText = (text, x, y, options = {}) => {
          if (typeof text !== 'string') text = String(text);
          doc.text(text, x, y, options);
          return y + (options.lineHeight || 10);
        };

        // En-tête
        doc.setFontSize(16);
        yPos = addText('Bon de Commande', margin, yPos, { align: 'left' });
        yPos += 5;

        doc.setFontSize(12);
        yPos = addText('Référence: ' + purchaseOrder.reference, margin, yPos);
        yPos = addText('Date: ' + purchaseOrder.date, margin, yPos);
        yPos += 10;

        // Info fournisseur
        doc.setFontSize(14);
        yPos = addText('Fournisseur:', margin, yPos);

        doc.setFontSize(12);
        yPos = addText(purchaseOrder.supplier.name, margin + 5, yPos);
        yPos = addText(purchaseOrder.supplier.address, margin + 5, yPos);
        yPos = addText(purchaseOrder.supplier.contact, margin + 5, yPos);
        yPos += 15;

        // Articles
        doc.setFontSize(14);
        yPos = addText('Articles commandés:', margin, yPos);
        yPos += 5;

        // Tableau des articles
        doc.autoTable({
          startY: yPos,
          head: [['Désignation', 'Quantité', 'Prix U.', 'Total']],
          body: purchaseOrder.articles.map(item => [
            item.designation || '',
            item.quantity || 0,
            (item.unitPrice || 0).toFixed(2) + ' €',
            ((item.unitPrice || 0) * (item.quantity || 0)).toFixed(2) + ' €'
          ]),
          margin: { left: margin },
          styles: {
            fontSize: 10,
            cellPadding: 3,
            overflow: 'linebreak'
          },
          headStyles: {
            fillColor: [58, 83, 155],
            textColor: 255,
            fontStyle: 'bold'
          }
        });

        // Total
        yPos = doc.lastAutoTable.finalY + 15;
        doc.setFontSize(12);
        doc.setFont(undefined, 'bold');
        addText('Total: ' + purchaseOrder.totalAmount.toFixed(2) + ' €', margin, yPos);

        // Sauvegarder
        doc.save(purchaseOrder.reference + '.pdf');

      } catch (error) {
        console.error("Erreur lors de la génération du bon de commande:", error);
        alert("Une erreur est survenue lors de la génération du PDF: " + error.message);
      }
      $scope.saveDataStorage(); // Sauvegarde après modification

    };


    $scope.generateContract = function (supplier) {
      supplier.contractGenerated = true;
      supplier.contractNumber = 'CONT-' + new Date().getFullYear() + '-' + Math.floor(1000 + Math.random() * 9000);
      const selectedArticles = $scope.getSelectedArticlesForSupplier(supplier);

      // Calcul du montant total
      const totalAmount = selectedArticles.reduce((sum, item) => sum + (item.soumission.prixUnitaire * item.quantite), 0);

      // Données du contrat
      const contractData = {
        title: "CONTRAT D'ACHAT N° " + $scope.appelOffre.reference + '-' + supplier.id,
        date: new Date().toLocaleDateString('fr-FR'),
        supplier: {
          name: supplier.name,
          address: supplier.address || 'Non renseigné',
          contact: supplier.contact || 'Non renseigné',
          fiscalId: supplier.fiscalId || 'Non renseigné'
        },
        buyer: {
          name: "VOTRE ENTREPRISE",
          address: "Adresse de votre entreprise",
          contact: "contact@votreentreprise.com"
        },
        articles: selectedArticles.map(item => ({
          designation: item.designation,
          quantity: item.quantite,
          unitPrice: item.soumission.prixUnitaire,
          deliveryDate: item.soumission.delaiLivraison || 'À convenir',
          condition: item.soumission.conditionLivraison || 'Non spécifié'
        })),
        terms: [
          "Paiement: 30 jours fin de mois",
          "Livraison: DDP selon Incoterms 2020",
          "Pénalités de retard: 0,5% par jour de retard",
          "Loi applicable: Droit français"
        ],
        validity: "1 an à compter de la date de signature",
        totalAmount: totalAmount
      };

      // Création du document PDF avec la même approche que exportToPDF
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      let yPosition = 20;

      // En-tête avec styles cohérents
      doc.setFontSize(16);
      doc.setTextColor(40, 53, 147);
      doc.text(contractData.title, 105, yPosition, null, null, 'center');
      yPosition += 10;

      doc.setFontSize(10);
      doc.setTextColor(100);
      doc.text("Date: " + contractData.date, 105, yPosition, null, null, 'center');
      yPosition += 20;

      // Parties contractantes
      doc.setFontSize(12);
      doc.setTextColor(0);
      doc.text("ENTRE :", 14, yPosition);
      yPosition += 8;

      // ... (le reste du contenu textuel reste inchangé)

      // Tableau des articles avec le même style que exportToPDF
      doc.autoTable({
        startY: yPosition,
        head: [['Désignation', 'Qté', 'Prix U.', 'Livraison', 'Condition', 'Total']],
        body: contractData.articles.map(item => [
          item.designation,
          item.quantity,
          item.unitPrice + ' €',
          item.deliveryDate,
          item.condition,
          (item.unitPrice * item.quantity).toFixed(2) + ' €'
        ]),
        margin: { left: 20 },
        styles: {
          fontSize: 8,
          cellPadding: 3,
          overflow: 'linebreak'
        },
        headStyles: {
          fillColor: [58, 83, 155],
          textColor: 255,
          fontStyle: 'bold'
        }
      });
      yPosition = doc.lastAutoTable.finalY + 10;

      // ... (le reste du contenu reste inchangé)

      // Sauvegarder le document
      doc.save(contractData.title + '.pdf');
      $scope.saveDataStorage(); // Sauvegarde après modification

    };
    // Récupère les articles sélectionnés pour un fournisseur
    $scope.getSelectedArticlesForSupplier = function (supplier) {
      return supplier.dossierfournisseur.soumissions
        .filter(s => s.selectedForArticle)
        .map(s => {
          const article = $scope.getArticleById(s.articleId);
          return {
            ...article,
            soumission: s
          };
        });
    };

    // Vérifie si un fournisseur a des articles sélectionnés


    $scope.hasAccordionValidatedSuppliers = function () {
      return $scope.appelOffre.daoData.suppliers.some(s => s.accordionValidated);
    };

    $scope.getAccordionValidatedSuppliers = function () {
      return $scope.appelOffre.daoData.suppliers.filter(s => s.accordionValidated);
    };
    $scope.selectFinalSupplierForArticle = function (supplier, articleId) {
      // Désélectionner tous les autres fournisseurs pour cet article
      const suppliers = $scope.getValidatedSuppliersForArticle(articleId);
      suppliers.forEach(s => {
        if (s.id !== supplier.id) {
          s.soumissionArticle.selectedForArticle = false;
        }
      });

      console.log('Fournisseur sélectionné:', supplier.name, 'pour l\'article:', articleId);
    };
    // Dans votre contrôleur
    // Dans votre contrôleur
    $scope.activeArticle = null;
    $scope.selectedSuppliers = {};
    $scope.validatedArticles = [];
    $scope.activeArticleSuppliers = [];

    // Mettre à jour les articles validés
    $scope.updateValidatedArticles = function () {
      const seenArticleIds = new Set();
      $scope.validatedArticles = [];

      if ($scope.dataPage['aos'] && $scope.dataPage['aos'][0] && $scope.dataPage['aos'][0].soumissions) {
        $scope.dataPage['aos'][0].soumissions.forEach(soumission => {
          const soumissionStatut = parseInt(soumission.statut, 10);

          if (soumissionStatut === 1 && soumission.soumissionarticles) {
            soumission.soumissionarticles.forEach(article => {
              const resultEvaluation = parseInt(article.resultatevaluation, 10);

              if (resultEvaluation === 1 && article.article && article.article.id) {
                if (!seenArticleIds.has(article.article.id)) {
                  $scope.validatedArticles.push({
                    id: article.article.id,
                    designation: article.article.designation,
                    code: article.article.code,
                    prixUnitaire: article.article.prix,
                    quantite: article.article.quantite,
                    margeValeur: article.margeValeur || 0,
                    margePourcentage: article.margePourcentage || 0
                  });
                  seenArticleIds.add(article.article.id);
                }
              }
            });
          }
        });
      }
    };

    // Définir l'article actif
    $scope.setActiveArticle = function (article) {
      $scope.activeArticle = article;
      $scope.selectedSuppliers = {};
      $timeout(function () {
        $scope.updateActiveArticleSuppliers();
      });
    };

    // Mettre à jour les fournisseurs pour l'article actif
    // Mettre à jour les fournisseurs pour l'article actif
    $scope.updateActiveArticleSuppliers = function () {
      if (
        !$scope.activeArticle ||
        !$scope.dataPage.aos ||
        !$scope.dataPage.aos[0] ||
        !$scope.dataPage.aos[0].soumissions
      ) {
        $scope.activeArticleSuppliers = [];
        return;
      }

      const suppliers = [];
      const soumissions = $scope.dataPage.aos[0].soumissions;

      // Listes de conditionnements simulés
      const cdsList = ["Boîte", "Plaquette", "Flacon"];
      const cdfList = ["Carton", "Palette", "Sachet"];

      angular.forEach(soumissions, function (soumission) {
        const supplierStatut = parseInt(soumission.statut, 10);

        if (supplierStatut === 1 && soumission.soumissionarticles) {
          angular.forEach(soumission.soumissionarticles, function (article) {
            const resultEvaluation = parseInt(article.resultatevaluation, 10);

            if (article.article.id == $scope.activeArticle.id && resultEvaluation === 1) {
              const isSelected = article.isselected == 1 || article.isselected === true;
              const quantiteDemande = parseInt(article.quantitedemande) || 0;
              const quantitePropose = parseInt(article.quantitepropose) || 0;
              const targetPrice = parseFloat(article.targetprice) || 0;
              const prixPropose = parseFloat(article.prixunitairepropose) || 0;

              // Générer conditionnements simulés
              const cds = cdsList[Math.floor(Math.random() * cdsList.length)];
              const cdf = cdfList[Math.floor(Math.random() * cdfList.length)];

              // Générer détails simulés
              const detailSimule = {
                numLot: "LOT-" + Math.floor(Math.random() * 10000),
                quantite: quantitePropose || quantiteDemande || 100,
                datePeremption: "2026-12-31",
                fabricant: soumission.fournisseur.nom || "Laboratoire XYZ"
              };

              suppliers.push({
                id: soumission.id,
                soumissionarticleId: article.id,
                nom: soumission.fournisseur.nom,
                isSelected: isSelected,
                prix: prixPropose,
                score: soumission.fournisseur.score || "0%",
                cds: cds,
                cdf: cdf,
                type: (article.typecondition && article.typecondition.designation) || "DDP",
                quantite: quantitePropose,
                targetprice: targetPrice,
                quantitedemande: quantiteDemande,
                ecart: quantiteDemande - quantitePropose,
                marge: targetPrice - prixPropose,
                detailSimule: detailSimule,
                isarticletemplate: soumission.isarticletemplate,
              });
            }
          });
        }
      });

      // Trier par prix
      suppliers.sort((a, b) => a.prix - b.prix);
      $scope.activeArticleSuppliers = suppliers;
    };
    $scope.recalculerClassement = function () {
      if (!$scope.activeArticleSuppliers) return;

      let rang = 1;

      // On parcourt les fournisseurs et on assigne un rang aux sélectionnés
      $scope.activeArticleSuppliers.forEach(function (soumission) {
        if (soumission.isSelected) {
          soumission.ranking = rang;
          rang++;
        } else {
          soumission.ranking = null; // pas sélectionné → pas de rang
        }
      });

      // On force Angular à re-render
      $scope.$applyAsync();
    };


    $scope.selectSupplier = function (supplierId, soumissionArticleId, isSelected) {

      // Désélectionner tous les autres si on coche un fournisseur
      if (isSelected) {
        $scope.activeArticleSuppliers.forEach(supplier => {
          if (supplier.id !== supplierId) {
            supplier.isSelected = false;
          }
        });
      }

      // Mettre à jour le statut en base (ton code)
      $scope.changeStatus({
        id: soumissionArticleId,
        type: 'soumissionarticle',
        champ: 'isselected',
        status: isSelected ? 1 : 0,
        action: 5,
        endpoint: 'status',
      });

      // Recalculer les rangs
      let rang = 2; // le coché = 1
      $scope.activeArticleSuppliers.forEach(supplier => {
        if (supplier.isSelected) {
          supplier.ranking = 1;
        } else {
          supplier.ranking = rang;
          rang++;
        }
      });

      $scope.$applyAsync();
    };

    // Fonction pour initialiser la sélection
    $scope.initializeSelection = function () {
      // S'assurer qu'un seul fournisseur est sélectionné
      let selectedCount = 0;
      let lastSelectedId = null;

      $scope.activeArticleSuppliers.forEach(supplier => {
        if (supplier.isSelected) {
          selectedCount++;
          lastSelectedId = supplier.id;
        }
      });

      // Si plus d'un fournisseur est sélectionné, ne garder que le dernier
      if (selectedCount > 1) {
        $scope.activeArticleSuppliers.forEach(supplier => {
          if (supplier.isSelected && supplier.id !== lastSelectedId) {
            supplier.isSelected = false;
            $scope.changeStatus({
              id: supplier.soumissionarticleId,
              type: 'soumissionarticle',
              champ: 'isselected',
              status: 0,
              action: 5,
              endpoint: 'status',
            });
          }
        });
      }
    };

    // Appeler l'initialisation après le chargement des données
    $scope.$watch('activeArticleSuppliers', function (newVal) {
      if (newVal && newVal.length > 0) {
        $scope.initializeSelection();
      }
    });

    // Vérifier si un fournisseur est sélectionné
    $scope.isSupplierSelected = function (supplierId) {
      return $scope.selectedSuppliers[supplierId] === true;
    };

    // Sélectionner un fournisseur


    // Surveiller les changements de données
    $scope.$watch('dataPage.aos', function (newVal) {
      if (newVal) {
        $scope.updateValidatedArticles();
      }
    }, true);

    // Initialiser
    $scope.updateValidatedArticles();

    // Vérifier s'il y a des articles valides
    $scope.hasValidArticles = function () {
      if (!$scope.dataPage.aos || !$scope.dataPage.aos[0] || !$scope.dataPage.aos[0].soumissions) {
        return false;
      }

      let hasValid = false;
      $scope.dataPage.aos[0].soumissions.forEach(supplier => {
        if (supplier.statut == 1 && supplier.soumissionarticles) {
          supplier.soumissionarticles.forEach(article => {
            if (article.resultatevaluation == 1) {
              hasValid = true;
            }
          });
        }
      });

      return hasValid;
    };

    // Obtenir les fournisseurs pour un article
    $scope.getSuppliersForArticle = function (articleId) {
      const suppliers = [];

      if (!$scope.dataPage.aos || !$scope.dataPage.aos[0] || !$scope.dataPage.aos[0].soumissions) {
        return suppliers;
      }

      $scope.dataPage.aos[0].soumissions.forEach(supplier => {
        if (supplier.statut == 1 && supplier.soumissionarticles) {
          supplier.soumissionarticles.forEach(article => {
            if (article.article.id == articleId && article.resultatevaluation == 1) {
              suppliers.push({
                id: supplier.id,
                name: supplier.fournisseur.nom,
                type: supplier.type,
                score: supplier.evaluation?.final_score || '0%',
                prix: article.prixUnitaire
              });
            }
          });
        }
      });

      // Trier par prix
      return suppliers.sort((a, b) => a.prix - b.prix);
    };



    /**
   * Sauvegarde l'appel d'offre dans le localStorage après vérification
   */
    $scope.saveDataStorage = function () {
      if (!$scope.appelOffre || !$scope.appelOffre.id) {
        console.error("Impossible de sauvegarder: appel d'offre invalide");
        return;
      }

      const storageKey = 'appelOffreState_' + $scope.appelOffre.id;

      try {
        // 1. Vérifier si la clé existe déjà
        const existingData = localStorage.getItem(storageKey);

        // 2. Supprimer l'ancienne valeur si elle existe
        if (existingData !== null) {
          localStorage.removeItem(storageKey);
          console.log("Anciennes données supprimées pour la clé:", storageKey);
        }

        // 3. Sauvegarder la nouvelle valeur
        localStorage.setItem(storageKey, JSON.stringify($scope.appelOffre));
        console.log("Nouvelles données sauvegardées pour la clé:", storageKey);

      } catch (e) {
        console.error("Erreur lors de la sauvegarde:", e);

        // Gestion spécifique du quota de stockage
        if (e.name === 'QuotaExceededError') {
          alert("L'espace de stockage est plein. Veuillez exporter vos données.");
          // Ici vous pourriez implémenter une logique pour archiver les anciennes données
        }
      }
    };

    $scope.hasValidatedSuppliers = function () {
      return $scope.appelOffre.daoData.suppliers.some(s => s.validated);
    };

    $scope.getValidatedSuppliers = function () {
      return $scope.appelOffre.daoData.suppliers.filter(s => s.validated);
    };
    $scope.hasSelectedSuppliers = function () {

    };
    $scope.getSelectedSuppliers = function () {
      const selectedSuppliersMap = new Map();

      if (!$scope.dataPage.aos || !$scope.dataPage.aos[0] || !$scope.dataPage.aos[0].soumissions) {
        return [];
      }

      // Parcourir tous les fournisseurs
      $scope.dataPage.aos[0].soumissions.forEach(soumission => {
        let hasSelectedArticles = false;
        let selectedArticlesCount = 0;

        // Vérifier si ce fournisseur a des articles sélectionnés
        if (soumission.soumissionarticles) {
          soumission.soumissionarticles.forEach(article => {
            // Vérifier si l'article est sélectionné (isselected = 1)
            if (article.isselected == 1) {
              hasSelectedArticles = true;
              selectedArticlesCount++;
            }
          });
        }

        // Si le fournisseur a des articles sélectionnés, l'ajouter à la liste
        if (hasSelectedArticles) {
          selectedSuppliersMap.set(soumission.id, {
            id: soumission.id,
            name: soumission.fournisseur ? soumission.fournisseur.nom : 'Non défini',
            type: soumission.fournisseur ? soumission.fournisseur.categoriefournisseur ? soumission.fournisseur.categoriefournisseur.designation : 'Non défini' : 'Non défini',
            selectedArticlesCount: selectedArticlesCount,
            commitevalidate: soumission.commitevalidate,
            etat_text: soumission.etat_text,
            etat_badge: soumission.etat_badge,
            selectedArticles: soumission.soumissionarticles ?
              soumission.soumissionarticles.filter(article => article.isselected == 1) : []
          });
        }
      });
      console.log(selectedSuppliersMap, "selectedSuppliersMap");
      return Array.from(selectedSuppliersMap.values());
    };
    // Fonction pour gérer la sélection/désélection
    $scope.toggleSupplierSelection = function (soumission, articleId) {
      if (soumission.isSelected) {
        // Si sélectionné, attribuer un rang automatiquement
        const selectedCount = $scope.getSelectedCount();
        soumission.ranking = selectedCount;

        // Sauvegarder en base de données
        $scope.updateSupplierSelection(soumission.soumissionarticleId, 1, soumission.ranking);
      } else {
        // Si désélectionné, réinitialiser le rang
        soumission.ranking = 0;

        // Réorganiser les rangs des autres fournisseurs sélectionnés
        $scope.reorganizeRankings();

        // Sauvegarder en base de données
        $scope.updateSupplierSelection(soumission.soumissionarticleId, 0, 0);
      }
    };



    $scope.getSupplierProgress = function (supplier) {
      let progress = 0;
      if (supplier.bcGenerated) progress += 40;
      if (supplier.contractGenerated) progress += 30;
      if (supplier.validated) progress += 30;
      return progress;
    };
    // Validation (simulée)
    $scope.validateSupplierDocuments = function (supplier) {
      supplier.validated = true;
      console.log('Documents validés pour', supplier.name);
      $scope.saveDataStorage(); // Sauvegarde après modification

    };

    $scope.hasSelectedArticles = function (supplier) {
      return supplier.dossierfournisseur.soumissions.some(s => s.selectedForArticle);
    };



    $scope.deselectSupplier = function (supplier) {
      supplier.dossierfournisseur.soumissions.forEach(s => {
        s.selectedForArticle = false;
        s.approuve = false;
      });
      supplier.validated = false;
    };
    $scope.calculateSupplierTotal = function (supplier) {
      return supplier.dossierfournisseur.soumissions.reduce((total, soumission) => {
        const article = $scope.getArticleById(soumission.articleId);
        return total + (soumission.prixUnitaire || 0) * article.quantite;
      }, 0);
    };

    $scope.updateApprovalStatus = function (soumission) {
      if (soumission.approuve) {
        soumission.statut = 'accepté';
        soumission.motifRejet = null;
      } else {
        soumission.statut = 'rejeté';
        if (!soumission.motifRejet) {
          soumission.motifRejet = 'Refusé par l\'acheteur';
        }
      }
      $scope.saveDataStorage(); // Sauvegarde après modification

    };


    // $scope.initializeExpedition = function () {
    //   if (!$scope.supplier) return;

    //   // Initialiser les propriétés manquantes
    //   $scope.supplier.delaiLivraison = $scope.supplier.delaiLivraison || `${Math.floor(Math.random() * 30) + 5} jours`;
    //   $scope.supplier.bcNumber = $scope.supplier.bcNumber || `BC-${Math.floor(1000 + Math.random() * 9000)}`;
    //   $scope.supplier.datearrivage = $scope.supplier.datearrivage || new Date(Date.now() + (14 + Math.floor(Math.random() * 14)) * 24 * 60 * 60 * 1000);

    //   // Le reste de votre code d'initialisation existant...
    //   if (!$scope.supplier.expedition) {
    //     const today = new Date();
    //     const arrivalDate = new Date(today);
    //     arrivalDate.setDate(today.getDate() + (14 + Math.floor(Math.random() * 14)));

    //     const genererNomFichier = (typeDocument) => {
    //       const extensions = ['pdf', 'docx', 'xlsx', 'jpg'];
    //       const extension = extensions[Math.floor(Math.random() * extensions.length)];
    //       return `${typeDocument}_${$scope.supplier.name.replace(/\s+/g, '_')}_${Date.now()}.${extension}`;
    //     };

    //     $scope.supplier.expedition = {
    //       factureProforma: genererNomFichier('factureProforma'),
    //       bonLivraison: genererNomFichier('bonLivraison'),
    //       documentTransit: $scope.supplier.type === 'Internationnal' ? genererNomFichier('documentTransit') : null,
    //       expeditionDate: null,
    //       estimatedArrival: arrivalDate.toISOString().split('T')[0],
    //       transportMode: 'Air',
    //       portArrivee: $scope.supplier.type === 'Internationnal' ? 'Tamatave' : null,
    //       aeroportArrivee: $scope.supplier.type === 'Internationnal' ? 'Ivato' : null,
    //       ordreTransit: $scope.supplier.type === 'Internationnal' ? genererNomFichier('ordreTransit') : null,
    //       transitaire: $scope.supplier.type === 'Internationnal' ? genererNomFichier('transitaire') : null,
    //       cabinetExpertise: $scope.supplier.type === 'Internationnal' ? genererNomFichier('cabinetExpertise') : null,
    //       domiciliationFacture: $scope.supplier.type === 'Internationnal' ? genererNomFichier('domiciliationFacture') : null,
    //       MIDAC: $scope.supplier.type === 'Internationnal' ? genererNomFichier('MIDAC') : null,
    //       quantiteLivree: 0,
    //       quantiteAvarier: 0,
    //       nonConformites: [],
    //       timeline: [{
    //         date: new Date(),
    //         title: 'Commande validée',
    //         description: 'Le fournisseur a été sélectionné et la commande validée'
    //       }],
    //       status: 'en_attente',
    //       documentsDate: new Date().toISOString()
    //     };

    //     if ($scope.supplier.type === 'Internationnal') {
    //       $scope.supplier.dossierfournisseur.documentsSpecifiques = {
    //         ordreTransit: genererNomFichier('ordreTransit'),
    //         transitaire: genererNomFichier('transitaire'),
    //         cabinetExpertise: genererNomFichier('cabinetExpertise'),
    //         domiciliationFacture: genererNomFichier('domiciliationFacture'),
    //         MIDAC: genererNomFichier('MIDAC')
    //       };
    //     }
    //   }

    //   $scope.supplier.dossierfournisseur.soumissions.forEach(s => {
    //     s.expeditionStatus = s.expeditionStatus || 'en_attente';
    //     s.expeditionComment = s.expeditionComment || '';
    //     s.quantiteLivree = s.quantiteLivree || 0;
    //     s.quantiteAvarier = s.quantiteAvarier || 0;
    //     s.nonConformites = s.nonConformites || [];
    //   });
    //   $scope.initializeExpeditionData();
    // };

    // $scope.initializeExpeditionDocuments = function () {
    //   if (!$scope.supplier) return;

    //   // Si expedition n'existe pas du tout, on l'initialise
    //   if (!$scope.supplier.expedition) {
    //     $scope.initializeExpedition();
    //     return;
    //   }

    //   // Fonction pour générer un nom de fichier aléatoire
    //   const genererNomFichier = (typeDocument) => {
    //     const extensions = ['pdf', 'docx', 'xlsx', 'jpg'];
    //     const extension = extensions[Math.floor(Math.random() * extensions.length)];
    //     return `${typeDocument}_${$scope.supplier.name.replace(/\s+/g, '_')}_${Date.now()}.${extension}`;
    //   };

    //   // On ne réinitialise PAS les documents existants, seulement s'ils sont null/undefined
    //   $scope.supplier.expedition.factureProforma = $scope.supplier.expedition.factureProforma || genererNomFichier('factureProforma');
    //   $scope.supplier.expedition.bonLivraison = $scope.supplier.expedition.bonLivraison || genererNomFichier('bonLivraison');

    //   if ($scope.supplier.type === 'Internationnal') {
    //     $scope.supplier.expedition.documentTransit = $scope.supplier.expedition.documentTransit || genererNomFichier('documentTransit');

    //     // Initialiser aussi les documents spécifiques s'ils n'existent pas
    //     $scope.supplier.dossierfournisseur.documentsSpecifiques = $scope.supplier.dossierfournisseur.documentsSpecifiques || {};
    //     $scope.supplier.dossierfournisseur.documentsSpecifiques.ordreTransit =
    //       $scope.supplier.dossierfournisseur.documentsSpecifiques.ordreTransit || genererNomFichier('ordreTransit');
    //     $scope.supplier.dossierfournisseur.documentsSpecifiques.transitaire =
    //       $scope.supplier.dossierfournisseur.documentsSpecifiques.transitaire || genererNomFichier('transitaire');
    //     $scope.supplier.dossierfournisseur.documentsSpecifiques.cabinetExpertise =
    //       $scope.supplier.dossierfournisseur.documentsSpecifiques.cabinetExpertise || genererNomFichier('cabinetExpertise');
    //     $scope.supplier.dossierfournisseur.documentsSpecifiques.domiciliationFacture =
    //       $scope.supplier.dossierfournisseur.documentsSpecifiques.domiciliationFacture || genererNomFichier('domiciliationFacture');
    //     $scope.supplier.dossierfournisseur.documentsSpecifiques.MIDAC =
    //       $scope.supplier.dossierfournisseur.documentsSpecifiques.MIDAC || genererNomFichier('MIDAC');
    //   }
    // };
    $scope.currentNonConformite = {};

    $scope.addNonConformite = function () {
      $scope.supplier.expedition.nonConformites.push(angular.copy($scope.currentNonConformite));
      $('#nonConformiteModal').modal('hide');

      // Mettre à jour la conformité de l'article
      const soumission = $scope.supplier.dossierfournisseur.soumissions.find(s => s.articleId === $scope.currentNonConformite.articleId);
      if (soumission) {
        soumission.conformite = 'non_conforme';
      }
    };
    $scope.removeNonConformite = function (index) {
      $scope.supplier.expedition.nonConformites.splice(index, 1);
    };
    $scope.getConformiteText = function (conformite) {
      const map = {
        'conforme': 'Conforme',
        'non_conforme': 'Non conforme',
        'partiellement_conforme': 'Partiellement conforme'
      };
      return map[conformite] || conformite;
    };
    // Validation de la livraison
    $scope.validateLivraison = function () {
      // Vérifier que toutes les quantités sont renseignées
      const isValid = $scope.supplier.dossierfournisseur.soumissions.every(s => {
        return s.quantiteLivree !== null && s.quantiteLivree !== undefined &&
          s.quantiteAvarier !== null && s.quantiteAvarier !== undefined;
      });

      if (!isValid) {
        toastr.error('Veuillez renseigner toutes les quantités livrées et avariées');
        return;
      }

      // Mettre à jour le statut
      $scope.supplier.expedition.status = 'livrée';
      $scope.supplier.expedition.livraisonDate = new Date();

      // Ajouter à l'historique
      $scope.supplier.expedition.timeline.push({
        date: new Date(),
        title: 'Livraison validée',
        description: 'Les quantités livrées ont été validées avec ' +
          $scope.supplier.expedition.nonConformites.length + ' non-conformité(s)'
      });

      toastr.success('Livraison validée avec succès');
      $scope.saveData(); // Fonction à implémenter pour sauvegarder les données
    };
    // Initialisation des données d'expédition
    $scope.initializeExpeditionData = function () {
      $scope.appelOffre.daoData.suppliers.forEach(supplier => {
        supplier.documentsExpedition = supplier.documentsExpedition || {
          bordereauValide: false,
          certificatValide: false
        };
        supplier.documentsExpeditionValides = supplier.documentsExpeditionValides || false;
        supplier.expeditionValidee = supplier.expeditionValidee || false;

        supplier.dossierfournisseur.soumissions.forEach(soumission => {
          const fabricants = [
            "Pfizer Inc.", "Novartis AG", "Roche Holding", "Merck & Co.",
            "GlaxoSmithKline", "Sanofi S.A.", "AstraZeneca", "Johnson & Johnson",
            "Eli Lilly", "Bayer AG", "AbbVie Inc.", "Amgen Inc.",
            "Gilead Sciences", "Bristol-Myers Squibb", "Takeda Pharmaceutical"
          ];
          // Fabriquant de soumission (fixe)
          soumission.fabriquantSoumission = fabricants[Math.floor(Math.random() * fabricants.length)];

          // Fabriquant de livraison (peut être différent)
          soumission.fabriquantLivraison = soumission.fabriquantLivraison ||
            soumission.fabriquantSoumission;

          // Vérifier initialement si différent
          soumission.fabriquantDifferent = soumission.fabriquantLivraison !== soumission.fabriquantSoumission;
          soumission.quantiteLivree = soumission.quantiteLivree || 0;
          soumission.ecartLivraison = soumission.ecartLivraison || 0;
          soumission.statutLivraison = soumission.statutLivraison || 'en_attente';
          soumission.livre = soumission.livre || false;
          soumission.nonConformite = soumission.nonConformite || null;
        });
      });
    };
    // Fonction pour vérifier si le fabricant est différent
    // $scope.verifierFabriquant = function (soumission) {
    //   soumission.fabriquantDifferent = soumission.fabriquantLivraison !== soumission.fabriquantSoumission;

    //   // Si le fabricant est différent, créer automatiquement une non-conformité
    //   if (soumission.fabriquantDifferent && !soumission.nonConformiteFabriquant) {
    //     $scope.creerNonConformiteFabriquant(soumission);
    //   }
    // };

    // Fonction pour créer une non-conformité automatique pour fabricant différent
    $scope.creerNonConformiteFabriquant = function (soumission) {
      const nonConformite = {
        articleId: soumission.articleId,
        type: 'fabriquant',
        description: `Fabricant différent: "${soumission.fabriquantLivraison}" au lieu de "${soumission.fabriquantSoumission}"`,
        gravite: 'majeure',
        actionCorrective: 'Vérification du certificat d\'analyse et contact avec le fournisseur',
        date: new Date(),
        autoGenerated: true
      };

      // Ajouter à l'historique des non-conformités
      soumission.nonConformites = soumission.nonConformites || [];
      soumission.nonConformites.push(nonConformite);
      soumission.nonConformiteFabriquant = true;

      console.log('Non-conformité fabricant créée:', nonConformite);
    };

    // Valider tous les documents d'expédition
    // $scope.validerDocumentsExpedition = function () {
    //   $scope.supplier.documentsExpeditionValides = true;
    //   $scope.supplier.documentsExpeditionRejetes = false;
    //   $scope.supplier.motifRejetDocuments = '';
    //   $scope.supplier.dateValidationDocuments = new Date();
    //   $scope.saveDataStorage();
    //   toastr.success('Documents validés avec succès', 'Succès');
    // };

    // Ouvrir le modal pour rejeter les documents
    // $scope.rejeterDocumentsExpedition = function () {
    //   $scope.motifRejetDocuments = '';
    //   $('#rejetDocumentsModal').modal('show');
    // };

    // // Confirmer le rejet des documents
    // $scope.confirmerRejetDocuments = function () {
    //   $scope.supplier.documentsExpeditionRejetes = true;
    //   $scope.supplier.documentsExpeditionValides = false;
    //   $scope.supplier.motifRejetDocuments = $scope.motifRejetDocuments;
    //   $scope.supplier.dateRejetDocuments = new Date();
    //   $scope.saveDataStorage();
    //   $('#rejetDocumentsModal').modal('hide');
    //   toastr.error('Documents rejetés', 'Rejet');
    // };

    // Rouvrir la validation des documents
    // $scope.reouvrirValidationDocuments = function () {
    //   $scope.supplier.documentsExpeditionRejetes = false;
    //   $scope.supplier.documentsExpeditionValides = false;
    //   $scope.supplier.motifRejetDocuments = '';
    //   $scope.saveDataStorage();
    //   toastr.info('Validation rouverte', 'Information');
    // };

    // Modifier la fonction canValidateExpedition pour inclure la validation des documents
    // $scope.canValidateExpedition = function () {
    //   return $scope.supplier.documentsExpeditionValides &&
    //     !$scope.supplier.expeditionValidee &&
    //     !$scope.supplier.documentsExpeditionRejetes;
    // };

    // // Vérifier si on peut valider l'expédition
    // $scope.canValidateExpedition = function () {
    //   return $scope.supplier.documentsExpeditionValides && !$scope.supplier.expeditionValidee;
    // };

    // // Valider l'expédition
    // $scope.validateExpedition = function (supplier) {
    //   if (!$scope.supplier.expeditionValidee && $scope.canValidateExpedition()) {
    //     supplier.expeditionValidee = true;
    //     supplier.dateExpedition = new Date();
    //     $scope.saveDataStorage();
    //     toastr.success('Expédition validée avec succès', 'Succès');
    //   }
    // };

    // Calculer l'écart de livraison
    // $scope.calculateEcartLivraison = function (soumission) {
    //   const article = $scope.getArticleById(soumission.articleId);
    //   soumission.ecartLivraison = soumission.quantiteLivree - article.quantite;
    //   $scope.saveDataStorage();
    // };
    // Fonction pour calculer l'écart de livraison
    // $scope.calculateEcartLivraison = function (soumission) {
    //   const quantiteCommandee = getArticleById(soumission.articleId).quantite;
    //   soumission.ecartLivraison = soumission.quantiteLivree - quantiteCommandee;

    //   // Mettre à jour le statut automatiquement
    //   if (soumission.quantiteLivree === 0) {
    //     soumission.statutLivraison = 'en_attente';
    //   } else if (soumission.quantiteLivree === quantiteCommandee) {
    //     soumission.statutLivraison = 'complet';
    //   } else if (soumission.quantiteLivree > 0) {
    //     soumission.statutLivraison = 'partiel';
    //   }
    //   $scope.saveDataStorage();

    // };
    // Fonction pour mettre à jour le statut de livraison
    // $scope.updateStatutLivraison = function (soumission) {
    //   const quantiteCommandee = getArticleById(soumission.articleId).quantite;

    //   if (soumission.statutLivraison === 'complet') {
    //     soumission.quantiteLivree = quantiteCommandee;
    //     soumission.ecartLivraison = 0;
    //   } else if (soumission.statutLivraison === 'en_attente') {
    //     soumission.quantiteLivree = 0;
    //     soumission.ecartLivraison = -quantiteCommandee;
    //   }
    // };
    // Fonction pour mettre à jour le statut livré
    // $scope.updateLivraisonStatus = function (soumission) {
    //   if (soumission.livre && soumission.statutLivraison === 'en_attente') {
    //     soumission.statutLivraison = 'complet';
    //     const quantiteCommandee = getArticleById(soumission.articleId).quantite;
    //     soumission.quantiteLivree = quantiteCommandee;
    //     soumission.ecartLivraison = 0;
    //   }
    //   $scope.saveDataStorage();

    // };

    // Mettre à jour le statut de livraison
    // $scope.updateLivraisonStatus = function (soumission) {
    //   if (soumission.livre) {
    //     soumission.statutLivraison = 'complet';
    //   }
    //   $scope.saveDataStorage();
    // };

    // Ouvrir le modal pour les non-conformités
    // $scope.openNonConformiteModal = function (soumission) {
    //   $scope.currentSoumission = soumission;
    //   $scope.currentNonConformite = soumission.nonConformite || {
    //     type: 'qualite',
    //     description: '',
    //     gravite: 'mineure',
    //     actionCorrective: '',
    //     date: new Date()
    //   };
    //   $('#nonConformiteModal').modal('show');
    // };

    // Sauvegarder la non-conformité
    // Obtenir l'historique des non-conformités
    // Fonction pour obtenir l'historique des non-conformités
    // $scope.getNonConformitesHistory = function () {
    //   const allNonConformites = [];

    //   // Utiliser $scope.supplier au lieu de $scope.appelOffre.daoData.suppliers
    //   if ($scope.supplier && $scope.supplier.dossierfournisseur && $scope.supplier.dossierfournisseur.soumissions) {
    //     $scope.supplier.dossierfournisseur.soumissions.forEach(soumission => {
    //       if (soumission.nonConformites && soumission.nonConformites.length > 0) {
    //         soumission.nonConformites.forEach(nc => {
    //           allNonConformites.push({
    //             ...nc,
    //             supplierName: $scope.supplier.name,
    //             articleId: soumission.articleId
    //           });
    //         });
    //       }
    //     });
    //   }

    //   return allNonConformites.sort((a, b) => new Date(b.date) - new Date(a.date));
    // };

    // Fonction pour obtenir le texte du type
    $scope.getTypeText = function (type) {
      const types = {
        'qualite': 'Problème qualité',
        'quantite': 'Quantité incorrecte',
        'delai': 'Retard livraison',
        'emballage': 'Emballage endommagé',
        'document': 'Document manquant',
        'fabriquant': 'Fabricant différent',
        'autre': 'Autre problème'
      };
      return types[type] || type;
    };

    // Obtenir le texte de la gravité
    // $scope.getGraviteText = function (gravite) {
    //   const gravites = {
    //     'mineure': 'Mineure',
    //     'majeure': 'Majeure',
    //     'critique': 'Critique'
    //   };
    //   return gravites[gravite] || gravite;
    // };

    // Obtenir la désignation de l'article
    // $scope.getArticleDesignation = function (articleId) {
    //   const article = $scope.getArticleById(articleId);
    //   return article ? article.designation : 'Article inconnu';
    // };

    // Supprimer une non-conformité
    // $scope.deleteNonConformite = function (nonConformite, index) {
    //   Swal.fire({
    //     title: 'Supprimer la non-conformité ?',
    //     text: 'Êtes-vous sûr de vouloir supprimer cette non-conformité ?',
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#d33',
    //     cancelButtonColor: '#3085d6',
    //     confirmButtonText: 'Oui, supprimer',
    //     cancelButtonText: 'Annuler'
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       // Trouver la soumission correspondante
    //       const soumission = $scope.supplier.dossierfournisseur.soumissions.find(s =>
    //         s.articleId === nonConformite.articleId
    //       );

    //       if (soumission) {
    //         soumission.nonConformite = null;
    //         soumission.statutLivraison = 'en_attente';
    //         $scope.saveDataStorage();
    //         toastr.success('Non-conformité supprimée', 'Succès');
    //       }
    //     }
    //   });
    // };

    // Modification de la fonction saveNonConformite pour inclure la date
    // $scope.saveNonConformite = function () {
    //   if (!$scope.currentSoumission) return;

    //   $scope.currentNonConformite.date = new Date();

    //   // Initialiser le tableau des non-conformités s'il n'existe pas
    //   $scope.currentSoumission.nonConformites = $scope.currentSoumission.nonConformites || [];

    //   // Ajouter la nouvelle non-conformité
    //   $scope.currentSoumission.nonConformites.push(angular.copy($scope.currentNonConformite));

    //   // Marquer la soumission comme ayant une non-conformité
    //   $scope.currentSoumission.nonConformite = true;
    //   $scope.currentSoumission.statutLivraison = 'rejeté';

    //   $scope.saveDataStorage();
    //   $('#nonConformiteModal').modal('hide');
    //   toastr.warning('Non-conformité enregistrée', 'Attention');

    //   // Réinitialiser pour la prochaine utilisation
    //   $scope.currentNonConformite = {
    //     type: 'qualite',
    //     description: '',
    //     gravite: 'mineure',
    //     actionCorrective: ''
    //   };
    // };

    // Calcul des totaux
    $scope.getTotalCommande = function () {
      return $scope.supplier.dossierfournisseur.soumissions.reduce((total, soumission) => {
        const article = $scope.getArticleById(soumission.articleId);
        return total + (article.quantite || 0);
      }, 0);
    };

    $scope.getTotalLivre = function () {
      return $scope.supplier.dossierfournisseur.soumissions.reduce((total, soumission) => {
        return total + (soumission.quantiteLivree || 0);
      }, 0);
    };

    $scope.getTotalEcart = function () {
      return $scope.getTotalLivre() - $scope.getTotalCommande();
    };

    // Statut de livraison
    // $scope.getLivraisonStatus = function () {
    //   const totalSoumissions = $scope.supplier.dossierfournisseur.soumissions.length;
    //   const livrees = $scope.supplier.dossierfournisseur.soumissions.filter(s => s.livre).length;

    //   if (livrees === 0) return 'en_attente';
    //   if (livrees === totalSoumissions) return 'complet';
    //   return 'en_cours';
    // };

    // $scope.getLivraisonStatusText = function () {
    //   const status = $scope.getLivraisonStatus();
    //   const texts = {
    //     'en_attente': 'En attente',
    //     'en_cours': 'En cours',
    //     'complet': 'Complet'
    //   };
    //   return texts[status];
    // };

    $scope.uploadDocument = function (documentType) {
      $scope.currentDocumentType = documentType;
      $scope.documentToUpload = null;
      $('#documentUploadModal').modal('show');
    };

    $scope.saveUploadedDocument = function () {
      if ($scope.documentToUpload) {
        // Simuler l'upload (à remplacer par un appel API réel)
        const fileName = 'document_' + new Date().getTime() + '_' + $scope.documentToUpload.name;
        $scope.supplier.expedition[$scope.currentDocumentType] = fileName;

        // Ajouter à la timeline
        $scope.addTimelineEvent('Document uploadé', $scope.currentDocumentType + ' téléversé');

        $('#documentUploadModal').modal('hide');
      }
    };

    $scope.downloadDocument = function (documentName) {
      // Simuler le téléchargement (à remplacer par un appel API réel)
      console.log('Téléchargement du document:', documentName);
      // window.open('/api/documents/download/' + documentName, '_blank');
    };

    $scope.updateExpedition = function () {
      // Ajouter à la timeline
      $scope.addTimelineEvent('Mise à jour', 'Informations d\'expédition mises à jour');

      // Simuler la sauvegarde (à remplacer par un appel API réel)
      console.log('Expédition mise à jour:', $scope.supplier.expedition);
      alert('Informations d\'expédition enregistrées avec succès');
    };




    $scope.rejectExpedition = function () {
      const reason = prompt('Veuillez saisir le motif du rejet:');
      if (reason) {
        $scope.supplier.expedition.status = 'rejetée';
        alert(`Expédition rejetée. Motif: ${reason}`);
      }
    };




    $scope.isExpeditionComplete = function () {
      if (!$scope.supplier || !$scope.supplier.expedition) {
        return false;
      }
      return $scope.supplier.expedition.status === 'validée';
    };



    $scope.addTimelineEvent = function (title, description) {
      $scope.supplier.expedition.timeline.push({
        date: new Date(),
        title: title,
        description: description
      });
    };

    $scope.getArticleById = function (articleId) {
      return $scope.appelOffre.articles.find(a => a.id === articleId);
    };

    // Initialisation

    $scope.calculateTotal = function (supplier) {
      return supplier.dossierfournisseur.soumissions.reduce((total, soumission) => {
        const article = $scope.getArticleById(soumission.articleId);
        return total + (soumission.prixUnitaire * article.quantite);
      }, 0);
    };

    $scope.getBestOffer = function (articleId) {
      let bestOffer = null;
      $scope.appelOffre.daoData.suppliers.forEach(supplier => {
        const soumission = supplier.dossierfournisseur.soumissions.find(s => s.articleId === articleId);
        if (soumission && soumission.prixUnitaire) {
          if (!bestOffer || soumission.prixUnitaire < bestOffer.prixUnitaire) {
            bestOffer = {
              supplier: supplier.name,
              prixUnitaire: soumission.prixUnitaire,
              condition: soumission.conditionLivraison
            };
          }
        }
      });
      return bestOffer;
    };

    $scope.getGlobalStatus = function (supplier) {
      const soumissions = supplier.dossierfournisseur.soumissions;
      if (soumissions.every(s => s.statut === 'accepté')) return 'Accepté';
      if (soumissions.some(s => s.statut === 'rejeté')) return 'Partiellement rejeté';
      if (soumissions.some(s => s.statut === 'en_attente')) return 'En attente';
      return 'Non soumis';
    };

    $scope.getCoefficient = function (condition) {
      switch (condition) {
        case 'CIF': return 1.15;
        case 'CIP': return 1.10;
        default: return 1.00;
      }
    };

    $scope.editSupplierSubmission = function (supplier) {
      $scope.currentSupplier = supplier;
      $('#submissionModal').modal('show');
    };

    $scope.openAddDocumentModal = function () {
      // $scope.newTechDoc = { name: '', file: null }; // Réinitialiser le formulaire
      // $('#modal_addarticledoc').modal('show');

      if (!$scope.dataInTabPane.daoDocuments['data']) {
        $scope.dataInTabPane.daoDocuments['data'] = [];
      }
      $scope.dataInTabPane.daoDocuments['data'].push({ "designation": "", "document": null });
    };


    // Fonction pour ajouter un document
    $scope.addTechDocToArticle = function () {
      if (!$scope.selectedArticle || !$scope.selectedArticle.specs) {
        console.error("Article ou specs non définis");
        return;
      }

      // if (!$scope.newTechDoc.name || !$scope.newTechDoc.file) {
      //   alert('Veuillez remplir tous les champs');
      //   return;
      // }

      // Initialisation du tableau si nécessaire
      $scope.selectedArticle.specs.documents = $scope.selectedArticle.specs.documents || [];

      // Ajouter le nouveau document
      $scope.selectedArticle.specs.documents.push({
        name: $scope.newTechDoc.name,
        file: $scope.newTechDoc.file,
        date: new Date()
      });

      // Fermer la modal et réinitialiser
      $('#modal_addarticledoc').modal('hide');
      $scope.newTechDoc = { name: '', file: null };
    };



    $scope.addDocDao = function () {
      if ($scope.getbesoin && $scope.getbesoin.id) {
        // Initialisation du tableau si nécessaire
        $scope.dataInTabPane.daoDocuments.data = $scope.dataInTabPane.daoDocuments.data || [];

        // Ajouter le nouveau document
        $scope.dataInTabPane.daoDocuments.data.push({
          designation: $scope.newTechDoc.designation,
          document: $("#document_articledoc").val(),
          date: new Date(),
          da_id: $scope.getbesoin.id
        });

        $("#document_articledoc").val(null)


        // Fermer la modal et réinitialiser
        $('#modal_addarticledoc').modal('hide');
        $scope.newTechDoc = { designation: '', document: null };
      }

    };

    // Fonction pour supprimer un document technique
    $scope.removeTechDocFromArticle = function (index) {
      if (!$scope.selectedArticle || !$scope.selectedArticle.specs || !$scope.selectedArticle.specs.documents) {
        console.error("Structure de données invalide");
        return;
      }

      if (confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) {
        $scope.selectedArticle.specs.documents.splice(index, 1);
      }
    };

    $scope.removeDocDao = function (index) {

      if (confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) {
        $scope.daoDocuments.splice(index, 1);
      }
    };

    // Fonction pour sauvegarder les spécifications
    $scope.saveArticleSpecs = function () {
      // Trouver l'index de l'article dans le target price
      const articleIndex = $scope.selectedTargetprice.articles.findIndex(
        a => a.id === $scope.selectedArticle.id
      );

      // Mettre à jour l'article dans la liste
      if (articleIndex !== -1) {
        $scope.selectedTargetprice.articles[articleIndex] = $scope.selectedArticle;
      }

      // Ici vous pourriez ajouter un appel API pour sauvegarder
      alert('Spécifications techniques enregistrées');
    };
    // Calcul du montant total
    $scope.getTotalAmount = function () {
      let total = 0;
      if ($scope.dataPage['detailsdas']) {
        $scope.dataPage['detailsdas'].forEach(function (article) {
          if (article.QTYSTU_0 && article.NETPRI_0) {
            total += article.QTYSTU_0 * article.NETPRI_0;
          }
        });
      }
      return total;
    };
    // Fonctions de validation
    $scope.validateStep = function (step, status, comment) {
      // Mise à jour du statut
      $scope.validationStatus[step] = {
        validated: status ? 1 : 0,
        comment: comment || '',
        date: new Date(),
        rejected: !status
      };

      $scope.daoData.etatgeneral++;
      console.log($scope.daoData.etatgeneral);

      // Sauvegarde
      $scope.saveDaoDraft();

      // Gestion du flux
      if (status) {
        // Validation - passer à l'étape suivante si possible
        const steps = ['resAchat', 'dirAchat', 'pharmaResp', 'dg'];
        const currentIndex = steps.indexOf(step);
        if (currentIndex < steps.length - 1) {
          $scope.currentValidationStep = steps[currentIndex + 1];
        } else {
          // Dernière étape validée - rester dessus
          $scope.currentValidationStep = step;
        }
      } else {
        // Rejet - afficher le message et rester sur l'étape
        alert('DAO rejeté à l\'étape ' + step + ': ' + (comment || 'Aucun motif fourni'));
        $scope.currentValidationStep = step;
      }

      $scope.$apply();
    };

    $scope.submitForValidation = function () {
      // Validation des champs obligatoires

      $scope.daoData.procedureType = $scope.getbesoin.type;
      console.log($scope.daoData, $scope.getbesoin);
      if (!$scope.daoData.procedureType) {
        alert('Veuillez sélectionner un type de procédure');
        return;
      }

      if ($scope.daoData.suppliers.length === 0) {
        alert('Veuillez ajouter au moins un fournisseur');
        return;
      }

      // Vérification des spécifications techniques
      const incompleteArticles = $scope.selectedTargetprice.articles.filter(article =>
        !article.specs || !article.specs.description
      );

      // if (incompleteArticles.length > 0) {
      //   alert('Veuillez compléter les spécifications techniques pour tous les articles');
      //   return;
      // }

      // Initialisation des données
      $scope.daoData.status = 'submitted';
      $scope.daoData.etatgeneral = 1;
      $scope.currentValidationStep = 'resAchat';

      // Initialisation complète du statut de validation
      $scope.validationStatus = {
        resAchat: { validated: null, comment: '', date: null, rejected: false },
        dirAchat: { validated: null, comment: '', date: null, rejected: false },
        pharmaResp: { validated: null, comment: '', date: null, rejected: false },
        dg: { validated: null, comment: '', date: null, rejected: false }
      };

      // Sauvegarde initiale
      $scope.saveDaoDraft();
      alert('DAO soumis avec succès pour validation');
    };

    $scope.addCritereSelection = function () {

      console.log($("#critere").val());
      console.log($("#coeff").val());
      console.log($("#score").val());

      if (!$scope.critereselections || $scope.critereselections.length < 0) {
        $scope.critereselections = [];
      }
      $scope.critereselections.push(
        {
          "coeff": +$("#coeff").val(),
          "critere": $("#critere").val(),
          "score": +$("#score").val()
        }
      );

      $("#critere").val("");
      $("#coeff").val(0);
      $("#score").val(0);
    }
    $scope.addEvenement = function () {

      $scope.addElementWithoutForm(
        {
          "designation": $("#nom_evement").val(),
          "date": $("#date_evement").val(),
          "id": $scope.getbesoin?.id,
        },
        'da/event',
        {
          from: "technical-evaluation",
          is_file_excel: false
        }
      );
      $("#nom_evement").val("");
      $("#date_evement").val("");
    }
    $scope.removeEvent = function (index) {
      if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
        $scope.evements.splice(index, 1);
      }
    }

    $scope.publishDao = function () {
      if (!confirm('Êtes-vous sûr de vouloir publier ce DAO ? Cette action est irréversible.')) {
        return;
      }

      $scope.daoData.status = 'published';
      $scope.daoData.publishedDate = new Date();


      // Enregistrer et rediriger
      $scope.saveDaoDraft().then(function () {
        alert('DAO publié avec succès');
        // Redirection ou autre action post-publication
      });
    };


    $scope.canSubmitDao = function () {
      // Vérifier qu'aucune étape n'est en état rejeté
      const steps = ['resAchat', 'dirAchat', 'pharmaResp', 'dg'];
      return steps.every(step =>
        $scope.validationStatus[step].validated !== 0 && $scope.validationStatus[step].validated !== null
      );
    };

    $scope.generateBc = function (sens) {
      let message = "Etes-vous sûr de vouloir valider le BC";
      let value = null;

      if (sens > 0) {
        message = "Etes-vous sûr de vouloir valider le BC?";
        value = 1;
      } else {
        message = "Etes-vous sûr de vouloir supprimer le BC?";
        value = null;
      }

      alert(message);
      $scope.daoData.bc = value;
      $scope.daoData.etatbc = 1;
      $scope.daoData.etatbc_text = 'BC généré';

    };
    $scope.generateBcFounissuer = function (sens) {

      let message = "Etes-vous sûr de vouloir valider le BC";
      let value = null;

      if (sens > 0) {
        message = "Etes-vous sûr de vouloir valider le BC?";
        value = 1;
      } else {
        message = "Etes-vous sûr de vouloir supprimer le BC?";
        value = null;
      }

      alert(message);
      $scope.supplier.bcGenerated = true;
      $scope.supplier.contractNumber = 'CONT-' + new Date().getFullYear() + '-' + Math.floor(1000 + Math.random() * 9000);
    };

    $scope.generateContrat = function (sens) {

      let message = "Etes-vous sûr de vouloir ajouter un contrat";
      let value = null;

      if (sens > 0) {
        $scope.openAddDocumentModalContrat();
      } else {
        message = "Etes-vous sûr de vouloir supprimer le BC?";
        alert(message);
        $scope.daoData.contrat = null;
      }

    };

    $scope.openAddDocumentModalContrat = function () {
      $scope.newTechDoc = { name: '', file: null }; // Réinitialiser le formulaire
      $('#modal_addcontrat').modal('show');
    };


    $scope.addContratDao = function () {
      // Vérifier que daoData existe, sinon l'initialiser
      if (!$scope.daoData) {
        $scope.daoData = {};
      }

      // Vérifier que daoData.contrat existe, sinon l'initialiser
      if (!$scope.daoData.contrat) {
        $scope.daoData.contrat = {};
      }

      // Ajouter le nouveau document
      $scope.daoData.contrat = {
        name: $scope.newTechDoc.name,
        file: $scope.newTechDoc.file,
        date: new Date()
      };

      // Fermer la modal et réinitialiser
      $('#modal_addcontrat').modal('hide');
      $scope.newTechDoc = { name: '', file: null };

      // Vérifier que daoData.etatbc existe avant de le modifier
      if ($scope.daoData.etatbc !== undefined) {
        $scope.daoData.etatbc = 2;
      }

      if ($scope.daoData.etatbc_text !== undefined) {
        $scope.daoData.etatbc_text = $scope.daoData.etatbc_text + ', Contrat généré';
      } else {
        $scope.daoData.etatbc_text = 'Contrat généré';
      }
      if (!$scope.supplier.contractGenerated) {
        $scope.supplier.contractGenerated = true;
      }

      // Sauvegarder les modifications
      $scope.saveDataStorage();
    };



    // Validation des prix
    // Validation des prix
    // Validation des prix
    $scope.validatePrices = function (isDG) {
      // Vérifier que tous les prix sont renseignés
      const hasEmptyPrices = $scope.articlestargetprices.some(article =>
        !article.prixUnitaire || article.prixUnitaire <= 0
      );

      if (hasEmptyPrices) {
        alert("Veuillez renseigner tous les prix avant validation");
        return;
      }

      const message = 'Êtes-vous sûr de vouloir confirmer?'//isDG
      // ? "Êtes-vous sûr de vouloir valider ces prix par la Direction Générale ?"
      //  : "Êtes-vous sûr de vouloir valider ces prix ?";

      // if (confirm(message)) {
      isDG = isDG + 1;
      $scope.selectedTargetprice.isprixvalide = isDG; // Validation DG
      $scope.selectedTargetprice.etat_text = isDG == 1 ? 'En attente Dr Achat' : 'En atente DG';


      console.log($scope.selectedTargetprice.isprixvalide);

      if (isDG == 1) {
        //$scope.selectedTargetprice.isprixvalidedg = 2; // Validation DG
        //$scope.selectedTargetprice.etat_text      = 'Vaidé par DG';
      } else if (isDG == 2) {
        //$scope.selectedTargetprice.isprixvalide = 1; // Validation normale
        // Réinitialiser la validation DG si revalidation
        //$scope.selectedTargetprice.etat_text      = 'En attente validation DG';
      } else if (isDG == 3) {
        $scope.selectedTargetprice.isprixvalidedg = 1;
        $scope.selectedTargetprice.etat_text = '';
      }

      // Supprimer les données de rejet si existantes
      delete $scope.selectedTargetprice.motifRejet;
      delete $scope.selectedTargetprice.dateRejet;

      // Mise à jour dans dataPage.targetprices
      const index = $scope.dataPage.targetprices.findIndex(tp => tp.id === $scope.selectedTargetprice.id);
      if (index !== -1) {
        $scope.dataPage.targetprices[index] = angular.copy($scope.selectedTargetprice);
      }

      alert(isDG ? "Validation par la DG réussie !" : "Validation réussie !");
      $scope.$apply();
      // }
    };

    // Initialisation des données de rejet
    $scope.showRejetForm = false;
    $scope.isRejetDG = false; // Pour savoir si c'est un rejet DG ou normal

    $scope.rejetData = {
      motif: ''
    };

    // Afficher le formulaire de rejet// Afficher le formulaire de rejet
    $scope.showRejet = function (isDG) {
      $scope.showRejetForm = true;
      $scope.isRejetDG = isDG;
      $scope.rejetData = {
        motif: ''
      };
    };

    // Annuler le rejet
    $scope.cancelRejet = function () {
      $scope.showRejetForm = false;
    };

    // Confirmer le rejet
    // Confirmer le rejet
    $scope.confirmRejet = function () {
      if (!$scope.rejetData.motif) {
        alert("Veuillez saisir un motif de rejet");
        return;
      }

      if (confirm("Êtes-vous sûr de vouloir rejeter ces prix ?")) {
        // Mise à jour du statut
        if ($scope.isRejetDG) {
          $scope.selectedTargetprice.isprixvalidedg = 2; // Rejet DG
        } else {
          $scope.selectedTargetprice.isprixvalide = 2; // Rejet normal
          $scope.selectedTargetprice.isprixvalidedg = 0; // Réinitialiser la validation DG si elle existait
        }

        $scope.selectedTargetprice.motifRejet = $scope.rejetData.motif;
        $scope.selectedTargetprice.dateRejet = new Date();

        // Mise à jour dans dataPage.targetprices
        const index = $scope.dataPage.targetprices.findIndex(tp => tp.id === $scope.selectedTargetprice.id);
        if (index !== -1) {
          $scope.dataPage.targetprices[index] = angular.copy($scope.selectedTargetprice);
        }

        $scope.showRejetForm = false;
        $scope.showMotif = true;
        alert("Les prix ont été rejetés avec succès");
        $scope.$apply();
      }
    };

    // Fonction utilitaire pour générer les IDs
    function generateNewId(items) {
      if (!items || items.length === 0) return 1;
      return Math.max(...items.map(item => item.id)) + 1;
    }

    $scope.showAddArticleForm = false;
    $scope.newArticle = {
      designation: '',
      quantite: 1
    };

    // Ajouter un article
    $scope.addArticle = function () {
      if (!$scope.newArticle.designation) {
        alert("La désignation est obligatoire!");
        return;
      }

      if (!$scope.newArticle.quantite || $scope.newArticle.quantite < 1) {
        alert("La quantité doit être supérieure à 0!");
        return;
      }

      $scope.articlesbesoins.push({
        id: generateNewId($scope.articlesbesoins),
        designation: $scope.newArticle.designation,
        quantite: $scope.newArticle.quantite
      });

      $scope.cancelAddArticle();
    };

    // Annuler l'ajout
    $scope.cancelAddArticle = function () {
      $scope.showAddArticleForm = false;
      $scope.newArticle = {
        designation: '',
        quantite: 1
      };
    };

    // Supprimer un article
    $scope.removeArticle = function (index) {
      if (confirm("Êtes-vous sûr de vouloir supprimer cet article ?")) {
        if ($scope.articlesbesoins) {
          $scope.articlesbesoins.splice(index, 1);
        }
        if ($scope.articlesappeloffres) {
          $scope.articlesappeloffres.splice(index, 1);
        }

        console.log($scope.articlesbesoins);
      }
    };

    // Validation
    $scope.showValidation = function () {
      if ($scope.articlesbesoins.length === 0) {
        alert("Ajoutez au moins un article avant de valider");
        return;
      }

      $scope.showValidationForm = true;
      $scope.validationData = {
        libelle: '',
        type: ''
      };
    };

    $scope.cancelValidation = function () {
      $scope.showValidationForm = false;
    };

    $scope.confirmValidation = function (section = null) {


      if ($scope.dataPage['detailsdas'].length === 0) {
        alert("Ajoutez au moins un article avant de valider");
        return;
      }

      if (!$scope.dataPage['detailsdas']) {
        console.error("Objet articlesbesoin non défini");
        alert("Erreur de validation");
        return;
      }

      var msg = "Confirmez-vous la validation ?";
      var title = "VALIDATION";

      iziToast.question({
        timeout: 0,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 4000,
        title: title,
        message: msg,
        position: "center",
        buttons: [
          [
            '<button class="font-bold btn btn-success" style="color: green!important">Confirmer</button>',
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");

              let type = 'da';
              let data = {
                "id": $scope.getbesoin.id,
                "statut": $scope.getbesoin.etat,
                "section": section
              }
              console.log(data, "data", $scope.getbesoin);

              if ($scope.getbesoin) {

                if ($scope.getbesoin.YTYPEPASS_0 == 3 || $scope.getbesoin.YTYPEPASS_0 == 4) {
                  console.log("dfff");
                  if ($scope.getbesoin.etat >= 3 && $scope.getbesoin.etat <= 5) {
                    data["details"] = $scope.dataPage['detailsdas'];
                  } else if ($scope.getbesoin.etat >= 6) {
                    //Validation des critere dao
                    if (section == 'criterdao') {
                      $scope.getbesoin['datepub'] = $("#datepub_da").val();
                      $scope.getbesoin['datecloture'] = $("#datecloture_da").val();
                      $scope.getbesoin['dateouvertureoffre'] = $("#dateouvertureoffre_da").val();

                      data["da"] = $scope.getbesoin;
                      // data["section"] = 'criterdao';
                    }
                    if (section == 'daofournisseur') {
                      // data["daofournisseur"] = $("#fournisseurs_da").val();
                      data["daofournisseur"] = $scope.dataPage['fournisseurs'] ?? null;
                    }


                    if ($scope.dataInTabPane.daoDocuments && $scope.dataInTabPane.daoDocuments.data) {

                      let form = $("#form_adddocumentdao");

                      let formdata = window.FormData ? new FormData(form[0]) : null;
                      let send_data = formdata !== null ? formdata : form.serialize();
                      console.log(send_data);
                      data["documentdaos"] = send_data;
                    }
                  }
                } else if ($scope.getbesoin.YTYPEPASS_0 == 8 || $scope.getbesoin.YTYPEPASS_0 == 6 || $scope.getbesoin.YTYPEPASS_0 == 5) {
                  if (section == 'daofournisseur') {
                    data["fournisseur_id"] = $("#supplierSelect_da").val();
                    data["da"] = $scope.getbesoin;
                    data["daofournisseur"] = $scope.dataInTabPane.fournisseurs_da.data ?? null;
                  }
                  if (section == 'criterdao') {
                    $scope.getbesoin['datepub'] = $("#datepub_da").val();
                    $scope.getbesoin['datecloture'] = $("#datecloture_da").val();
                    $scope.getbesoin['dateouvertureoffre'] = $("#dateouvertureoffre_da").val();
                    data["da"] = $scope.getbesoin;
                  }

                }
              }
              console.log(data, "check");
              Init.changeStatut(type, data).then(
                function (data) {
                  if (data.data && !data.errors) {
                    $scope.showToast(title, "Succès", "success");
                    console.log(data, "data");
                    // $scope.getbesoin = data.data['data'];
                    $scope.getelements(
                      "das",
                      null,
                      (filtres = "id:" + $scope.id)
                    );
                    if (section == 'daofournisseur') {
                      $scope.chargeFournisseur();
                    } else if (section == 'criterdao') {

                    } else {
                      $scope.getelements(
                        "detailsdas",
                        null,
                        (filtres = "da_id:" + $scope.getbesoin.id)
                      );
                    }

                  } else {
                    $scope.showToast(title, data.errors_debug, "error");
                  }
                },
                function (msg) {
                  $scope.showToast(title, msg, "error");
                }
              );
            },
            true,
          ],
          [
            '<button class="btn btn-danger" style="color: red!important">Annuler</button>',
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
          ],
        ],
        onClosing: function (instance, toast, closedBy) { },
        onClosed: function (instance, toast, closedBy) { },
      });
    };

    $scope.submitForValidationTransport = function () {
      alert("Validation documents et critères?");
      $scope.offretransportsaxes.isqtevalide = 2;
      $scope.offretransportsaxes.etatdao_text = "Validé";
    }


    $scope.confirmValidationtransport = function () {

      alert("Validation axes et tonnages?");
      $scope.offretransportsaxes.isqtevalide = $scope.offretransportsaxes.isqtevalide == 1 ? 2 : 1;
      $scope.offretransportsaxes.etat_text = $scope.offretransportsaxes.isqtevalide == 1 ? "Validé" : " ";
      //  $scope.offretransportsaxes.articles = angular.copy($scope.articlesbesoins);



    };

    $scope.showCancelForm = false;
    $scope.showCform = function () {
      $scope.showCancelForm = true;
    }
    $scope.cancelData = {
      motif: '',
      dateAnnulation: null
    };

    // Afficher le formulaire d'annulation
    $scope.showCancelValidation = function () {
      $scope.showCancelForm = true;
      $scope.cancelData = {
        motif: '',
        dateAnnulation: new Date()
      };
    };


    // Annuler l'annulation
    $scope.cancelCancelForm = function () {
      $scope.showCancelForm = false;
      $scope.cancelData = {
        motif: '',
        dateAnnulation: null
      };
    };

    // Confirmer l'annulation
    $scope.confirmCancel = function () {
      if (!$scope.cancelData.motif) {
        alert("Veuillez saisir un motif d'annulation");
        return;
      }

      if (confirm("Êtes-vous sûr de vouloir annuler cette validation ?")) {
        $scope.articlesbesoin.isqtevalide = 3;
        $scope.articlesbesoin.etat_text = "Annulé";
        $scope.articlesbesoin.annulation = {
          motif: $scope.cancelData.motif,
          dateAnnulation: new Date()
        };
        // Mise à jour du statut
        $scope.articlesbesoin.annulation = angular.copy($scope.cancelData);

        // Mise à jour dans dataPage.besoins
        const besoinIndex = $scope.dataPage.besoins.findIndex(b => b.id === $scope.articlesbesoin.id);
        if (besoinIndex !== -1) {
          $scope.dataPage.besoins[besoinIndex] = angular.copy($scope.articlesbesoin);
        }

        // Mise à jour de l'appel d'offre associé s'il existe
        const appelOffreIndex = $scope.dataPage.appeldoffres.findIndex(ao =>
          ao.besoinId === $scope.articlesbesoin.id);

        if (appelOffreIndex !== -1) {
          $scope.dataPage.appeldoffres[appelOffreIndex].statut = 'annule';
          $scope.dataPage.appeldoffres[appelOffreIndex].motifAnnulation = $scope.cancelData.motif;
          $scope.dataPage.appeldoffres[appelOffreIndex].dateAnnulation = new Date();
        }

        $scope.showCancelForm = false;
        alert("Validation annulée avec succès");
        $scope.$apply();
      }
    };

    $scope.currentDaoTab = 'criteria';

    $scope.chargeFournisseur = function (typefournisseur, categoriefournisseur) {
      $scope.getelements("daofournisseurs", null, "da_id:" + $scope.getbesoin.id);
      $scope.getelements(
        "fournisseurs",
        null,
        'categoriefournisseur:"' + typefournisseur + '",typefournisseur:"' + categoriefournisseur + '"'
      );
    }

    // Objet temporaire pour nouveau document technique
    $scope.newTechDoc = {
      name: '',
      file: null
    };

    // Ajouter un document technique
    // Méthodes pour gérer les documents techniques
    $scope.addTechDoc = function (article) {
      if (!$scope.newTechDoc.name || !$scope.newTechDoc.name.trim()) {
        alert('Veuillez saisir un nom pour le document');
        return;
      }

      article.specs.documents = article.specs.documents || [];
      article.specs.documents.push({
        name: $scope.newTechDoc.name.trim(),
        file: $scope.newTechDoc.file,
        date: new Date()
      });

      $scope.newTechDoc = { name: '', file: null };
      article.currentDocTab = 'list';
    };
    // Supprimer un document technique
    $scope.removeTechDoc = function (article, index) {
      if (confirm('Supprimer ce document technique ?')) {
        article.specs.documents.splice(index, 1);
      }
    };

    // Modifier la fonction saveDaoDraft pour inclure les fournisseurs
    $scope.saveDaoDraft = function () {
      // Sauvegarde des données DAO
      const index = $scope.dataPage.targetprices.findIndex(tp => tp.id === $scope.selectedTargetprice.id);
      if (index !== -1) {
        // Sauvegarde complète des données
        $scope.selectedTargetprice.daoData = angular.copy($scope.daoData);
        $scope.selectedTargetprice.validationStatus = angular.copy($scope.validationStatus);
        $scope.dataPage.targetprices[index] = angular.copy($scope.selectedTargetprice);
      }

      // Pas de message d'alerte pour ne pas interrompre le flux
    };

    // Ajouter un fournisseur
    // Filtrer les fournisseurs déjà sélectionnés
    $scope.filterSuppliers = function (supplier) {
      return !$scope.daoData.suppliers.some(s => s.id === supplier.id);
    };

    // Ajouter un fournisseur sélectionné
    // Dans votre contrôleur, ajoutez cette variable
    $scope.newSupplierObservation = '';
    $scope.articleSearch = '';

    $scope.addSupplier = function () {
      const selectedValue = $("#supplierSelect").val();
      if (!selectedValue) {
        return;
      }
      if (!$scope.getbesoin) return;

      let supplierId = selectedValue.toString().replace('number:', '');
      let selectedId = parseInt(supplierId, 10);
      let observation = $("#supplierObservation").val();

      let fournisseur = $scope.dataPage['fournisseurs'].find(f => f.id === selectedId);
      if (!fournisseur) {
        return;
      }

      let data = {
        id: selectedId,
        nom: fournisseur.nom,
        observation: observation
      };

      // 👉 bien cibler l'objet dans $scope
      if (!$scope.dataInTabPane.fournisseurs_da) {
        $scope.dataInTabPane.fournisseurs_da = { data: [] };
      }

      // ✅ Cas spécial : si YTYPEPASS_0 == 8 → un seul fournisseur max
      if ($scope.getbesoin.YTYPEPASS_0 == 8 && $scope.dataInTabPane.fournisseurs_da.data.length > 0) {
        $scope.showToast("Error", " Vous ne pouvez ajouter qu'un seul fournisseur pour Achat direct", "error");
        return;
      }
      $scope.dataInTabPane.fournisseurs_da.data.push(data);
      $("#supplierSelect").val(null);
      $("#supplierObservation").val('');
    };



    // Supprimer un fournisseur
    $scope.removeSupplier = function (index) {
      if (confirm("Retirer ce fournisseur de la liste ?")) {
        $scope.daoData.suppliers.splice(index, 1);
      }
    };

    // Visualiser un document
    $scope.viewDocument = function (doc) {
      if (doc.file) {
        if (doc.file instanceof File) {
          // Pour les nouveaux fichiers uploadés
          const url = URL.createObjectURL(doc.file);
          window.open(url, '_blank');
        } else if (doc.file.url) {
          // Pour les fichiers déjà sauvegardés
          window.open(doc.file.url, '_blank');
        } else {
          alert("Document non disponible pour visualisation");
        }
      } else {
        alert("Aucun fichier associé à ce document");
      }
    };

    // $scope.getTypeText = function (type) {
    //   const types = {
    //     'AON': 'Appel Offre National',
    //     'AOI': 'Appel Offre International',
    //     'AOR': 'Appel Offre Restreint',
    //     'AchatDirect': 'Achat Direct',
    //     'Consultation': 'Consultation',
    //     'LTA': 'LTA'
    //   };
    //   return types[type] || type;
    // };

    $scope.getStatusText = function (ao) {
      if (ao.statut === 'annule') return 'Annulé';
      if (ao.statut === 'cloture') return 'Clôturé';
      if (ao.statut === 'attribution') return 'Attribué';
      if (ao.statut === 'eval') return 'En évaluation';
      return 'En cours';
    };

    $scope.getStatusBadgeClass = function (ao) {
      if (ao.statut === 'annule') return 'bg-danger';
      if (ao.statut === 'cloture') return 'bg-secondary';
      if (ao.statut === 'attribution') return 'bg-success';
      if (ao.statut === 'eval') return 'bg-info';
      return 'bg-primary';
    };

    $scope.getStatusBackground = function (ao) {
      if (ao.statut === 'annule')
        return { 'background': 'linear-gradient(to bottom, #ef4444 40%, #dc2626 100%)' };
      if (ao.statut === 'cloture')
        return { 'background': 'linear-gradient(to bottom, #6b7280 40%, #4b5563 100%)' };
      if (ao.statut === 'attribution')
        return { 'background': 'linear-gradient(to bottom, #10b981 40%, #059669 100%)' };
      if (ao.statut === 'eval')
        return { 'background': 'linear-gradient(to bottom, #0ea5e9 40%, #0284c7 100%)' };
      return { 'background': 'linear-gradient(to bottom, #3b82f6 40%, #2563eb 100%)' };
    };

    $scope.getProgressPercentage = function (ao) {
      if (!ao.date_ouverture || !ao.date_cloture) return 0;

      const start = new Date(ao.date_ouverture);
      const end = new Date(ao.date_cloture);
      const now = new Date();

      if (now >= end) return 100;
      if (now <= start) return 0;

      const total = end - start;
      const elapsed = now - start;
      return Math.round((elapsed / total) * 100);
    };
    $scope.getProgressBarClass = function (ao) {
      const percent = $scope.getProgressPercentage(ao);
      if (percent > 90) return 'bg-danger';
      if (percent > 70) return 'bg-warning';
      return 'bg-success';
    };

    $scope.filterByType = function (type) {
      return function (item) {
        // Filtre pour le tab actif
        const activeTab = document.querySelector('#achatTabs .nav-link.active').id;

        if (activeTab === 'appel-offres-tab') return true;
        if (activeTab === 'achat-direct-tab') return item.type === 'AchatDirect';
        if (activeTab === 'consultation-tab') return item.type === 'Consultation';
        if (activeTab === 'lta-tab') return item.type === 'LTA';
        return true;
      };
    };

    // Publier le DAO et créer l'appel d'offre
    $scope.submitDao = function () {
      if (!confirm("Êtes-vous sûr de vouloir publier ce DAO ?")) {
        return;
      }

      $scope.daoData.status = 'published';
      $scope.daoData.datePublication = new Date();
      $scope.daoData.publicationDate = new Date();

      // 1. Mettre à jour le target price
      const tpIndex = $scope.dataPage.targetprices.findIndex(tp => tp.id === $scope.selectedTargetprice.id);
      if (tpIndex !== -1) {
        $scope.selectedTargetprice.daoData = angular.copy($scope.daoData);
        $scope.selectedTargetprice.criteresEvaluation = angular.copy($scope.criteresEvaluation);
        $scope.selectedTargetprice.requiredDocuments = angular.copy($scope.requiredDocuments);
        $scope.selectedTargetprice.daoDocuments = angular.copy($scope.daoDocuments);
        $scope.selectedTargetprice.daoStatus = 'published';

        $scope.dataPage.targetprices[tpIndex] = angular.copy($scope.selectedTargetprice);
      }

      // 2. Créer l'appel d'offre
      const newAppelOffre = {
        id: generateNewId($scope.dataPage.appeldoffres),
        reference: 'AO-' + ($scope.dataPage.appeldoffres.length + 1).toString().padStart(4, '0'),
        libelle: 'Appel d\'offre basé sur target price ' + $scope.selectedTargetprice.reference,
        type: $scope.daoData.procedureType,
        typefounisseur: null,
        dateCreation: new Date(),
        statut: 'en_cours',
        targetPriceId: $scope.selectedTargetprice.id,
        articles: angular.copy($scope.selectedTargetprice.articles),
        daoData: angular.copy($scope.daoData)
      };
      console.log(newAppelOffre);

      $scope.dataPage.appeldoffres.push(newAppelOffre);
      console.log($scope.dataPage.appeldoffres);
      // $scope.appelOffre = newAppelOffre;
      // $scope.saveDataStorage();
      alert('DAO publié avec succès et appel d\'offre créé !');
      $scope.daoData.etatappeloffre = 1;
      $scope.daoData.etatappeloffre_text = 'Appel d\'offre publié';
    };

    $scope.changeStateAO = function (statut) {
      if (!confirm("Êtes-vous sûr de vouloir faire cette action ?")) {
        return;
      }
      $scope.appelOffre.statut = statut;
      $scope.$apply();
      alert('AO  succès ');

    }
    $scope.getTotalArticles = function () {
      if (!$scope.appelOffre || !$scope.appelOffre.articles) return 0;
      return $scope.appelOffre.articles.reduce((total, article) => {
        return total + (article.quantite * article.targetprice);
      }, 0);
    };
    $scope.getValidationProgress = function () {
      const steps = ['resAchat', 'dirAchat', 'pharmaResp', 'dg'];
      const completed = steps.filter(step =>
        $scope.validationStatus[step].validated === 1).length;
      return (completed / steps.length) * 100;
    };


    // Fonction utilitaire pour générer des IDs
    function generateNewId(items) {
      if (!items || items.length === 0) return 1;
      return Math.max(...items.map(item => item.id)) + 1;
    }


    // REDIRECTION vers detail
    $scope.customRedirect = (url, id, other) => {
      if (other) {
        $scope.selectedAnnee = parseInt(other);
      }
      $location.url("/" + url + "/" + id);
    };

    $scope.selectList = (id) => {

      if (id !== 0) {
        let list = $scope.dataPage['tempbesoins'].filter(
          (p) => p.id == id
        );
        $scope.dataPage['besoins'] = list;
      } else {
        $scope.dataPage['besoins'] = $scope.dataPage['tempbesoins'];
      }

    };

    //  $scope.activeStep = 1; // Par défaut, le premier step est actif

    $scope.chargeData = function (id, type) {
      if ($scope.getbesoin) {
        id = $scope.getbesoin.id
        if (type == 'targetprice') {
          $scope.selectedTargetprice = $scope.dataPage.targetprices.find(c => c.id === parseInt(id));

          if ($scope.selectedTargetprice) {
            $scope.articlestargetprices = $scope.selectedTargetprice.articles || [];

            // Initialiser les prix unitaires si non définis  
            $scope.articlestargetprices.forEach(article => {
              article.prixUnitaire = article.prixUnitaire || 0;
            });
            $scope.initializeCoefficients();
          }
        }
        else if (type == 'dao') {

          console.log(id, "id");

          //          $scope.daoData.procedureType = $scope.getbesoin.type;
          $scope.selectedTargetprice = $scope.dataPage.targetprices.find(c => c.id === parseInt(id));

          // Initialisation des spécifications pour chaque article
          $scope.selectedTargetprice.articles.forEach(article => {
            article.specs = article.specs || {
              description: '',
              normes: '',
              documents: []
            };
            article.currentDocTab = 'add';
          });

          // Initialisation des données DAO
          if (!$scope.daoData || !$scope.daoData.bc) {
            $scope.daoData = $scope.selectedTargetprice.daoData || {
              procedureType: '',
              status: 'draft',
              suppliers: [], // Ajout de la liste des fournisseurs
              date_ouverture: null,
              date_cloture: null,
              budget: null
            };
          }


          $scope.criteresEvaluation = $scope.selectedTargetprice.criteresEvaluation || [
            { label: 'Prix', selected: true, ponderation: 40 },
            { label: 'Délai de livraison', selected: true, ponderation: 20 },
            { label: 'Expérience similaire', selected: true, ponderation: 15 },
            { label: 'Qualité technique', selected: true, ponderation: 25 }
          ];


          console.log($scope.dataPage['documentspecifications']);
          if ($scope.dataPage['documentspecifications'] && $scope.dataPage['documentspecifications'].length > 0) {
            for (let i = 0; i < $scope.dataPage['documentspecifications'].length; i++) {
              if ($scope.dataPage['documentspecifications'][i]['etape'] === "A la soumission") {
                if (!$scope.requiredDocuments || $scope.requiredDocuments.length < 0) {
                  $scope.requiredDocuments = [];
                }
                $scope.requiredDocuments.push(
                  {
                    name: $scope.dataPage['documentspecifications'][i]['designation'],
                    nature: $scope.dataPage['documentspecifications'][i]['designation'],
                    required: true
                  }
                );
              }

              if ($scope.dataPage['documentspecifications'][i]['etape'] === "Suivi marché") {
                if (!$scope.requiredDocumentsSuivimarche || $scope.requiredDocumentsSuivimarche.length < 0) {
                  $scope.requiredDocumentsSuivimarche = [];
                }
                $scope.requiredDocumentsSuivimarche.push(
                  {
                    name: $scope.dataPage['documentspecifications'][i]['designation'],
                    nature: $scope.dataPage['documentspecifications'][i]['designation'],
                    required: true
                  }
                );
              }
            }
          }

          if (!$scope.daoDocuments || $scope.daoDocuments.length <= 0) {
            $scope.daoDocuments = $scope.selectedTargetprice.daoDocuments || [
              {
                name: 'Cahier des charges',
                description: 'Document détaillant les exigences techniques',
                file: null
              },
              {
                name: 'Règlement de consultation',
                description: 'Règles de la procédure',
                file: null
              }
            ];
          }



          // Nouvel objet pour ajouter des fournisseurs
          $scope.newSupplier = {
            name: '',
            contact: '',
            email: '',
            phone: '',
            experience: 0
          };

          $scope.newTechDoc = {
            name: '',
            file: null
          };
          // Ajouter la liste complète des fournisseurs disponibles
          $scope.allSuppliers = $scope.dataPage.fournisseurs || [];
          $scope.selectedSupplier = null;
          // Initialiser la liste des fournisseurs sélectionnés si elle n'existe pas
          $scope.daoData.suppliers = $scope.daoData.suppliers || [];

          // Dans la section d'initialisation du DAO
          $scope.daoData.annexes = $scope.selectedTargetprice.daoData?.annexes || {
            fnrs: {
              cahier_charges: true,
              reglement_consultation: true,
              modele_contrat: true
            },
            soumissionnaires: {
              attestation_fiscale: true,
              extrait_kbis: true,
              references_clients: false,
              certificat_qualification: false,
              autres_documents: false,
              autres_documents_libelle: ''
            }
          };
          $scope.daoData.modeles = $scope.selectedTargetprice.daoData?.modeles || {
            modele1: false,
            modele2: false,
            modele3: false,
          };
          $scope.daoData.validation = $scope.daoData.validation || {
            criteria: { etat: '', dateSoumission: null, dateResAchat: null, dateDirAchat: null, dateDg: null },
            specs: { etat: '', dateSoumission: null, dateResAchat: null, dateDirAchat: null, dateDg: null },
            suppliers: { etat: '', dateSoumission: null, dateResAchat: null, dateDirAchat: null, dateDg: null }
          };

          // Dans la section d'initialisation du DAO, ajouter :
          $scope.validationStatus = $scope.selectedTargetprice.validationStatus || {
            resAchat: { validated: null, comment: '', date: null },
            dirAchat: { validated: null, comment: '', date: null },
            pharmaResp: { validated: null, comment: '', date: null },
            dg: { validated: null, comment: '', date: null }
          };
          $scope.currentValidationStep = 'resAchat'; // Initialiser à la première étape


        }
      }

    }
    // Fonction pour obtenir le texte du statut
    $scope.getValidationStatusText = function (etat) {
      switch (etat) {
        case 'soumis': return 'Soumis';
        case 'resAchat': return 'Resp. Achat';
        case 'dirAchat': return 'Dir. Achat';
        case 'dg': return 'DG Validé';
        default: return 'Non soumis';
      }
    };
    $scope.soumettreSection = function (section) {
      $scope.daoData.validation[section].etat = 'soumis';
      $scope.daoData.validation[section].dateSoumission = new Date();

      // Sauvegarder l'état de validation
      $scope.saveDaoDraft();

    };

    // ---------------------------------------------------------
    // Fonction pour obtenir le texte du statut de validation
    $scope.getValidationStatusTextV1 = function (etat) {
      switch (etat) {
        case 'soumis': return 'Soumis';
        case 'resAchat': return 'Validé Resp. Achat';
        case 'dirAchat': return 'Validé Dir. Achat';
        case 'dg': return 'Validé DG';
        default: return 'Non soumis';
      }
    };

    $scope.soumettreValidationV1 = function (supplier) {
      if (!supplier.validation) {
        supplier.validation = {};
      }
      supplier.validation.etat = 'soumis';
      supplier.validation.dateSoumis = new Date();
      supplier.validation.soumisPar = 'Utilisateur actuel';

      showToast('Fournisseur soumis pour validation', 'success');
    };

    $scope.resAchatValidationV1 = function (supplier) {
      supplier.validation.etat = 'resAchat';
      supplier.validation.dateResAchat = new Date();
      supplier.validation.valideParResAchat = 'Resp. Achat';

      showToast('Validé par le Responsable Achat', 'success');
    };

    $scope.dirAchatValidationV1 = function (supplier) {
      supplier.validation.etat = 'dirAchat';
      supplier.validation.dateDirAchat = new Date();
      supplier.validation.valideParDirAchat = 'Dir. Achat';

      showToast('Validé par le Directeur Achat', 'success');
    };

    $scope.dgValidationV1 = function (supplier) {
      supplier.validation.etat = 'dg';
      supplier.validation.dateDg = new Date();
      supplier.validation.valideParDg = 'DG';

      showToast('Validé par le Directeur Général', 'success');
    };

    $scope.canValidateStep = function (supplier, step) {
      const etats = ['non_soumis', 'soumis', 'resAchat', 'dirAchat', 'dg'];
      const currentEtat = supplier.validation?.etat || 'non_soumis';
      const currentIndex = etats.indexOf(currentEtat);
      const stepIndex = etats.indexOf(step);

      // Autoriser uniquement la validation de l’étape suivante immédiate
      return stepIndex === currentIndex + 1;
    };


    // ---------------------------------------------------

    // Fonctions pour valider les étapes (à appeler par les validateurs)
    $scope.validerSectionResAchat = function (section) {
      if ($scope.daoData.validation[section].etat === 'soumis') {
        $scope.daoData.validation[section].etat = 'resAchat';
        $scope.daoData.validation[section].dateResAchat = new Date();
        $scope.saveDaoDraft();
      }
    };

    $scope.validerSectionDirAchat = function (section) {
      if ($scope.daoData.validation[section].etat === 'resAchat') {
        $scope.daoData.validation[section].etat = 'dirAchat';
        $scope.daoData.validation[section].dateDirAchat = new Date();
        $scope.saveDaoDraft();
      }
    };

    $scope.validerSectionDg = function (section) {
      if ($scope.daoData.validation[section].etat === 'dirAchat') {
        $scope.daoData.validation[section].etat = 'dg';
        $scope.daoData.validation[section].dateDg = new Date();
        $scope.saveDaoDraft();
        toastr.success('Validé par DG!');
      }
    };
    $scope.validateSection = function (section) {
      $scope.daoData.validation[section] = true;
      $scope.saveDaoDraft();
    };

    // Validation Responsable Achat
    $scope.resAchatValidation = function (section) {
      if ($scope.daoData.validation[section].etat === 'soumis') {
        $scope.daoData.validation[section].etat = 'resAchat';
        $scope.daoData.validation[section].dateResAchat = new Date();
        $scope.saveDaoDraft();
        toastr.success('Validé par Responsable Achat!');
      }
    };

    // Validation Directeur Achat
    $scope.dirAchatValidation = function (section) {
      if ($scope.daoData.validation[section].etat === 'resAchat') {
        $scope.daoData.validation[section].etat = 'dirAchat';
        $scope.daoData.validation[section].dateDirAchat = new Date();
        $scope.saveDaoDraft();
        toastr.success('Validé par Directeur Achat!');
      }
    };

    // Validation DG
    $scope.dgValidation = function (section) {
      if ($scope.daoData.validation[section].etat === 'dirAchat') {
        $scope.daoData.validation[section].etat = 'dg';
        $scope.daoData.validation[section].dateDg = new Date();
        $scope.saveDaoDraft();
        toastr.success('Validé par DG!');
      }
    };

    // Fonction pour vérifier si toutes les sections sont validées par le DG
    $scope.isAllSectionsValidated = function () {
      return $scope.daoData.validation.criteria.etat === 'dg' &&
        $scope.daoData.validation.specs.etat === 'dg' &&
        $scope.daoData.validation.suppliers.etat === 'dg';
    };

    $scope.resetSectionValidations = function () {
      $scope.daoData.validation = {
        criteria: false,
        specs: false,
        suppliers: false
      };
    };
    // Fonction pour calculer la marge à partir du PA et coefficient
    $scope.calculerMarge = function (article) {
      if (article.NETPRI_0 !== undefined && article.GROPRI_0 !== undefined) {
        // Marge valeur = PV - PA
        article.margevaleur = article.GROPRI_0 - article.NETPRI_0;

        // Marge pourcentage = (Marge valeur / PA) * 100
        article.margepourcentage = article.NETPRI_0 > 0 ? (article.margevaleur / article.NETPRI_0) * 100 : 0;
      } else {
        article.margevaleur = 0;
        article.margepourcentage = 0;
      }
    };

    $scope.calculerMargeFromPV = function (article) {
      if (article.NETPRI_0 && article.coefficient) {
        const pvTheorique = article.NETPRI_0 * article.coefficient;
        pvTheorique = 0;
        article.margevaleur = article.GROPRI_0 - pvTheorique;
        article.margevaleur = article.GROPRI_0 - article.NETPRI_0;
        article.margepourcentage = pvTheorique > 0 ? (article.margevaleur / pvTheorique) * 100 : 0;
      } else {
        article.margevaleur = 0;
        article.margepourcentage = 0;
      }
    };

    $scope.calculerMargeDirecte = function (article) {
      if (article.prixRevient && article.GROPRI_0) {
        // Marge valeur = PV - Prix de revient (soustraction directe)
        article.margevaleur = article.GROPRI_0 - article.prixRevient;

        // Marge pourcentage = (Marge valeur / Prix de revient) * 100
        article.margepourcentage = article.prixRevient > 0 ? (article.margeValeur / article.prixRevient) * 100 : 0;
      } else {
        article.margevaleur = 0;
        article.margepourcentage = 0;
      }
    };

    // Fonction pour calculer le total de la marge valeur
    $scope.getTotalMargeValeur = function () {
      if (!$scope.dataPage['detailsdas']) return 0;
      return $scope.dataPage['detailsdas'].reduce((total, article) => {
        return total + (article.margevaleur || 0);
      }, 0);
    };
    // Fonction pour initialiser les coefficients par défaut
    $scope.initializeCoefficients = function () {
      if ($scope.articlestargetprices) {
        $scope.articlestargetprices.forEach(article => {
          article.prixAchat = article.prixAchat || 0;
          article.prixRevient = article.prixRevient || 0;
          article.margeValeur = article.margeValeur || 0;
          article.margePourcentage = article.margePourcentage || 0;

          // Initialiser le calcul de la marge
          $scope.calculerMarge(article);
        });
      }
    };


    // Fonction pour calculer la marge totale en pourcentage
    // Fonction pour calculer la marge totale en pourcentage
    $scope.getTotalMargePourcentage = function () {
      const totalPA = $scope.dataPage['detailsdas'].reduce((total, article) => {
        return total + (article.NETPRI_0 || 0);
      }, 0);

      const totalMargeValeur = $scope.getTotalMargeValeur();

      return totalPA > 0 ? (totalMargeValeur / totalPA) * 100 : 0;
    };



    $scope.setActiveStep = function (step = null, type = null, module = null) {
      $scope.activeStep = !step ? 1 : step;

      // Mettre à jour les classes des steps
      const steps = document.querySelectorAll('.stepper-item');
      steps.forEach((el, index) => {
        el.classList.remove('active', 'completed');
        if (index + 1 < step) {
          el.classList.add('completed');
        } else if (index + 1 === step) {
          el.classList.add('active');
        }
      });

      // Ici vous pouvez ajouter une logique pour charger le contenu correspondant au step
      // Par exemple :
      switch (step) {
        case 1:
          // Charger les données de quantification
          break;
        case 2:
          // Charger les données target price
          break;
        case 3:
          // Charger les données DAO
          break;
        case 4:
          // Charger les données finalisation
          break;
      }

      console.log(step, type, module);


      if (module == 'transport') {
        if (step == 1) {
          // if (!$scope.offretransportsaxes || $scope.offretransportsaxes.length <= 0) {
          //   $scope.dataPage['offretransports'] =
          //     [
          //       {
          //         id: 1,
          //         "designation": "Offre d'expédition 2025-2026",
          //         "axes": [
          //           {
          //             axe: "ALAOTRA MANGORO",
          //             code: "001",
          //             description: "",
          //             relais: 3,
          //             tonnages: [
          //               {
          //                 designation: "2 essieux: 19 tonnes.",
          //                 valeur: 19,
          //                 unite: "T"
          //               },
          //               {
          //                 designation: "3 essieux: 26 tonnes.",
          //                 valeur: 26,
          //                 unite: "T"
          //               },
          //               {
          //                 designation: "4 essieux et plus",
          //                 valeur: 32,
          //                 unite: "T"
          //               }
          //             ]
          //           },
          //           {
          //             axe: "AMORON'I MANIA",
          //             code: "002",
          //             description: "",
          //             relais: 3,
          //             tonnages: [
          //               {
          //                 designation: "2 essieux: 19 tonnes.",
          //                 valeur: 19,
          //                 unite: "T"
          //               },
          //               {
          //                 designation: "3 essieux: 26 tonnes.",
          //                 valeur: 26,
          //                 unite: "T"
          //               },
          //               {
          //                 designation: "4 essieux et plus",
          //                 valeur: 32,
          //                 unite: "T"
          //               }
          //             ]
          //           },
          //           {
          //             axe: "ATSIMO ANDREFANA",
          //             code: "007",
          //             description: "",
          //             relais: 3,
          //             tonnages: [
          //               {
          //                 designation: "2 essieux: 19 tonnes.",
          //                 valeur: 19,
          //                 unite: "T"
          //               },
          //               {
          //                 designation: "3 essieux: 26 tonnes.",
          //                 valeur: 26,
          //                 unite: "T"
          //               },
          //               {
          //                 designation: "4 essieux et plus",
          //                 valeur: 32,
          //                 unite: "T"
          //               }
          //             ]
          //           }
          //         ]
          //       }
          //     ];
          //   $scope.offretransportsaxes = $scope.dataPage['offretransports'][0];
          // }

        }

      } else {
        if (step == 4) {
          $location.url("/" + 'list-ao');
        } else {
          $scope.chargeData($scope.idDa, type);
        }
      }



    };



    // Initialisation au chargement
    $scope.setActiveStep($scope.activeStep);


    $scope.getCategorie = function (PSHNUM_0) {
      if (!PSHNUM_0) return "BIEN ET SERVICE"; // si la valeur est vide ou null

      if (PSHNUM_0.startsWith("MED")) {
        return "MEDICAMENT";
      } else {
        return "BIEN ET SERVICE";
      }
    };




    $scope.generateConfirmationMessage = function (type, optionals, texte) {
      let msg = "";
      let title = "";
      let status = 0;
      let send_data;

      switch (optionals.index) {
        case 0:
          msg = "Voulez-vous vraiment Enregistrer les modifications?";
          title = "Modifications";
          send_data =
            type === "detailfichevisite"
              ? $scope.dataPage["visites"][0]
              : $scope.dataPage[type + "s"][0];
          break;
        case 2:
          if (optionals.status === 0) {
            msg = "Voulez-vous vraiment valider cette section?";
            title = "Validation";
            status = 1;
          } else if (optionals.status === 1) {
            msg =
              "Voulez-vous vraiment annuler la validation de cette section?";
            title = "Annulation";
            status = 0;
          }
          send_data = {
            id:
              type === "detailfichevisite"
                ? $scope.dataPage["visites"][0]["id"]
                : $scope.dataPage[type + "s"][0]["id"],
            champ: optionals.champ,
            status: status,
            param: $scope.dataPage["visites"],
            commercial_id: $scope.dataPage["visites"],
            pointdevente_id: $scope.dataPage["visites"],
          };
          break;
        case 3:
          if (optionals.status === 0) {
            msg = "Voulez-vous vraiment valider cette section?";
            title = "Validation";
            status = 1;
          } else if (optionals.status === 1) {
            msg =
              "Voulez-vous vraiment annuler la validation de cette section?";
            title = "Annulation";
            status = 0;
          }
          send_data = {
            ids:
              type === "detailfichevisite"
                ? $scope.dataPage["visites"]
                : $scope.dataPage[type + "s"],
            champ: optionals.champ,
            status: status,
          };
          break;
        default:
          if (optionals.status === 0) {
            msg = "Voulez-vous vraiment valider cette section?";
            title = "Validation";
            status = 1;
          } else if (optionals.status === 1) {
            msg =
              "Voulez-vous vraiment annuler la validation de cette section?";
            title = "Annulation";
            status = 0;
          }
          send_data = {
            id:
              type === "detailfichevisite"
                ? $scope.dataPage["visites"][0]["id"]
                : $scope.dataPage[type + "s"][0]["id"],
            champ: optionals.champ,
            status: status,
          };
          break;
      }

      return { msg, title, send_data };
    };

    $scope.generateActionData = function (params = {}) {
      // Initialisation des valeurs par défaut
      const {
        type = "",
        action = 1, // 1: enregistrement, 2: validation, 3: annulation, 4: suppression
        additionalData = {},
      } = params;

      // Messages par défaut en fonction de l'action
      const actionMessages = {
        1: { msg: "Voulez-vous enregistrer ?", title: "Enregistrement" },
        2: { msg: "Voulez-vous valider ?", title: "Validation" },
        3: { msg: "Voulez-vous annuler ?", title: "Annulation" },
        4: { msg: "Voulez-vous supprimer ?", title: "Suppression" },
        5: { msg: "Voulez-vous modifier ?", title: "Modification" },
      };

      // Récupération des valeurs selon l'action
      const { msg = "Action inconnue", title = "Confirmation" } =
        actionMessages[action] || {};

      // Données finales à renvoyer
      return {
        type,
        action,
        msg,
        title,
        data: { ...additionalData }, // Fusionner les données supplémentaires
      };
    };

    $scope.areAllValidated = function (visites, attr) {
      return visites.every((visite) => visite[attr] === 1);
    };

    $scope.changeStatus = function (params = {}) {
      // Initialisation des valeurs par défaut
      const {
        id,
        type = "",
        ids = [],
        champ = null,
        status = 0,
        optionals = { data: [] },
        action = 1,
        endpoint = null,
      } = params;

      // Génération des données d'action
      const actionData = $scope.generateActionData({
        type,
        action,
        additionalData: optionals.data,
      });

      // Préparation des données à envoyer
      $tabParams = $location
        .path()
        .split("/")
        .filter(
          (elmt) =>
            elmt &&
            elmt !== "list-validation" &&
            elmt !== "list-detailfichevisite"
        );
      console.log($tabParams);
      const sendData = {
        id,
        ids,
        champ,
        status,
        action: actionData.action,
        type: actionData.type,
        params: $tabParams,
      };
      if (Object.keys(actionData.data).length > 0) {
        sendData.data = JSON.stringify(actionData.data);
      }




      // Confirmation et exécution de l'action
      if (endpoint) {
        iziToast.question({
          timeout: 0,
          close: false,
          overlay: true,
          displayMode: "once",
          id: "question",
          zindex: 4000,
          title: actionData.title,
          message: actionData.msg,
          position: "center",
          buttons: [
            [
              '<button class="font-bold btn btn-success" style="color: green!important">Confirmer</button>',
              function (instance, toast) {
                $.blockUI();

                instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                Init.changeStatut(type, sendData, endpoint).then(
                  function (data) {
                    $.unblockUI();
                    if (data.data && !data.errors) {
                      instance.hide(
                        {
                          transitionOt: "fadeOut",
                        },
                        toast,
                        "button"
                      );
                      console.log($scope.id, "$scope.id", type);
                      if (type === "dossiersoumission" || type === "soumission" || type === "detailao" || type === "soumissionarticle") {
                        $scope.getelements("aos", null, (filtres = "id:" + $scope.id));
                      } else {
                        $scope.pageChanged(type);
                      }

                      if (type === "soumission" && $scope.currentTemplateUrl.indexOf("list-contractuelle") !== -1) {
                        $scope.getelements("soumissions", null, (filtres = "id:" + $scope.id));
                      }




                      // Affichage du message de toast
                      $scope.showToast(
                        data.message || "MODIFICATION",
                        "success",
                        "success"
                      );

                      // $scope.pageChanged(type);
                    } else {
                      $scope.showToast("Error", "", "error");
                    }
                  },
                  function (msg) {
                    $scope.showToast("error", msg, "error");
                  }
                );
              },
              true,
            ],
            [
              '<button class="btn btn-danger" style="color: red!important">Annuler</button>',
              function (instance, toast) {
                instance.hide({ transitionOut: "fadeOut" }, toast, "button");
              },
            ],
          ],
          onClosing: function (instance, toast, closedBy) { },
          onClosed: function (instance, toast, closedBy) { },
        });
      } else {
        console.warn("Aucun endpoint défini.");
      }
    };

    // Add element in database and in scope
    $scope.addElement = function (
      e,
      type,
      optionals = {
        from: "modal",
        is_file_excel: false,
        index: null,
        status: null,
        champ: null,
        route: null,
        operation: null
      }
    ) {

      if (e != null) {
        e.preventDefault();
      }
      let form = $("#form_add" + (optionals.is_file_excel ? "liste" : type));

      let formdata = window.FormData ? new FormData(form[0]) : null;
      let send_data = formdata !== null ? formdata : form.serialize();

      // A ne pas supprimer
      send_dataObj = form.serializeArray();
      continuer = true;
      let id_form = null;
      send_dataObj.forEach(function (field) {
        if (field.name === "id") {
          id_form = field.value;
        }
      });

      $.each($scope.dataInTabPane, function (keyItem, valueItem) {
        tagType = "_" + type;
        if (keyItem.indexOf(tagType) !== -1) {
          send_data.append(
            keyItem.substring(0, keyItem.length - tagType.length),
            JSON.stringify($scope.dataInTabPane[keyItem]["data"])
          );
        }
      });

      let getparam;

      if (optionals?.index != null) {
        getparam = $scope.generateConfirmationMessage(type, optionals);
        send_data = getparam.send_data;
      }

      if (type === "contrat") {
        type = "soumission_upload";

        // ajouter des champs dans send_date
        send_data.append("champ", "urlcontrat");
        send_data.append("model", "soumission");
        send_data.append("contrat", "iscontrat");
      }
      if (type === "document" || type == "annexe") {
        type = optionals.route;
        // ajouter des champs dans send_date
        send_data.append("champ", optionals?.champ);
        send_data.append("type", optionals?.operation);
        console.log(type, "type");
      }

      //continuer = false
      if (form.validate() && continuer) {
        $.blockUI();
        // return false
        Init.saveElementAjax(type, send_data, optionals.is_file_excel).then(
          function (data) {
            if (send_data.id) {
              $scope.conserveFilter = true;
            }
            $.unblockUI();
            if (data.data != null && !data.errors) {
              $scope.evaluation = {};
              if (
                (type === "lignecommande" &&
                  $scope.currentTemplateUrl.indexOf("list-lignecommande") !== -1) ||
                (type === "bailleur" &&
                  $scope.currentTemplateUrl.indexOf("list-bailleur") !== -1) ||
                ((type === "campagne") &&
                  $scope.currentTemplateUrl.indexOf("list-detailprogramme") !== -1)
              ) {
                $scope.pageChanged("programme");
              } if (
                ((type === "phasedepot") &&
                  $scope.currentTemplateUrl.indexOf("list-detailprogramme") !== -1) ||
                ((type === "lignecommande") &&
                  $scope.currentTemplateUrl.indexOf("list-detailprogramme") !== -1) ||
                ((type === "lignecommande") &&
                  $scope.currentTemplateUrl.indexOf("list-detailcampagneproduit") !== -1) ||
                ((type === "phasedepot") &&
                  $scope.currentTemplateUrl.indexOf("list-detailcampagne") !== -1)
              ) {
                $scope.getelements("campagnes");
              } else if (type === "soumission_upload" && $scope.currentTemplateUrl.indexOf("list-contractuelle") !== -1) {
                type = "contrat";
                $scope.getelements("soumissions", null, (filtres = "id:" + $scope.id));
              } else if (type === "da/soumission_upload" && $scope.currentTemplateUrl.indexOf("list-preparation") !== -1) {
                type = optionals?.operation === "dadocument" ? "document" : "annexe";
                $scope.getelements("das", null, (filtres = "id:" + $scope.id));
                $scope.getelements(
                  "detailsdas",
                  null,
                  (filtres = "da_id:" + $scope.id)
                );
              } else if (type === "chauffeur" && $scope.currentTemplateUrl.indexOf("list-chauffeur") !== -1) {
                $scope.pageChanged(
                  type,
                  optionals = {
                    justWriteUrl: null,
                    option: null,
                    saveStateOfFilters: false,
                    order: null,
                    queryfilters: "estinterne:0"
                  }
                );
              } else if (type === "prequalification" && $scope.currentTemplateUrl.indexOf("list-dossiersoumission") !== -1) {
                $scope.getelements(
                  "aos",
                  null,
                  (filtres = "id:" + $scope.id)
                );
              } else if (type === "statutamm" && $scope.currentTemplateUrl.indexOf("list-dossiersoumission") !== -1) {
                $scope.getelements(
                  "aos",
                  null,
                  (filtres = "id:" + $scope.id)
                );
              } else {
                $scope.pageChanged(type);
              }

              $scope.showToast(
                !id_form ? "AJOUT" : "MODIFICATION",
                "Succès",
                "success"
              );
              $("#modal_add" + (optionals.is_file_excel ? "list" : type)).modal(
                "hide"
              );
              $scope.closeModal(
                "#modal_add" + (optionals.is_file_excel ? "list" : type)
              );
            } else if (data.errors && data.errors.length > 0) {
              for (let field in data.errors) {
                $.unblockUI();
                $scope.showToast(
                  id_form ? "AJOUT" : "MODIFICATION",
                  `<span class="h4">${data.errors[field].message}</span>`,
                  "error"
                );
              }
            } else {
              $.unblockUI();
              $scope.showToast(
                !id_form ? "AJOUT" : "MODIFICATION",
                '<span class="h4">Erreur depuis le serveur, veuillez contacter l\'administrateur</span>',
                "error"
              );
            }
            $("#modal_add" + (optionals.is_file_excel ? "list" : type)).modal(
              "hide"
            );
            $scope.closeModal(
              "#modal_add" + (optionals.is_file_excel ? "list" : type)
            );
          },
          function (error) {
            if (error.status) {
              let validationErrors = error.data.data;
              for (let field in validationErrors) {
                if (validationErrors.hasOwnProperty(field)) {
                  validationErrors[field].forEach(function (message) {
                    $.unblockUI();
                    $scope.showToast(
                      !id_form ? "AJOUT" : "MODIFICATION",
                      `<span class="h4">${message}</span>`,
                      "error"
                    );
                  });
                }
              }
            } else {
              $.unblockUI();
              $scope.showToast(
                !id_form ? "AJOUT" : "MODIFICATION",
                '<span class="h4">Erreur depuis le serveur, veuillez contacter l\'administrateur</span>',
                "error"
              );
            }
          }
        );
      }
    };


    $scope.addElementWithoutForm = function (
      objet,
      type,
      optionals = {
        from: "modal",
        is_file_excel: false,
        index: null,
        status: null,
        champ: null,
      }
    ) {
      let formData = new FormData();
      let continuer = true;
      let id_form = objet?.id || null;

      // ⚠️ On reconstruit comme dans addElement
      for (let key in objet) {
        if (objet.hasOwnProperty(key) && objet[key] !== null && typeof objet[key] !== "undefined") {
          if (Array.isArray(objet[key]) || typeof objet[key] === "object") {
            formData.append(key, JSON.stringify(objet[key])); // sérialisation si objet ou array
          } else {
            formData.append(key, objet[key]);
          }
        }
      }

      if (continuer) {
        $.blockUI();

        Init.saveElementAjax(type, formData, optionals.is_file_excel).then(
          function (data) {
            $.unblockUI();
            console.log(data);

            if (data.data != null && !data.errors) {
              if (id_form) {
                $scope.conserveFilter = true;
              }

              if (type === "save_technical_evaluation") {
                $scope.getelements("aos", null, (filtres = "id:" + $scope.id));
              } else if (type === "da/event") {
                $scope.getelements("das", null, (filtres = "id:" + $scope.id));
              }
              console.log($scope.id, "id filter");

              $scope.pageChanged(type);

              $scope.showToast(
                !id_form ? "AJOUT" : "MODIFICATION",
                "Succès",
                "success"
              );
              $.unblockUI();
            } else if (data.errors && data.errors.length > 0) {
              for (let field in data.errors) {
                $scope.showToast(
                  id_form ? "MODIFICATION" : "AJOUT",
                  `<span class="h4">${data.errors[field].message}</span>`,
                  "error"
                );
              }
            } else {
              $scope.showToast(
                !id_form ? "AJOUT" : "MODIFICATION",
                '<span class="h4">Erreur depuis le serveur, veuillez contacter l\'administrateur</span>',
                "error"
              );
            }
          },
          function (error) {
            console.log(error);
            $.unblockUI();
            if (error.status) {
              let validationErrors = error.data?.data;
              for (let field in validationErrors) {
                validationErrors[field].forEach(function (message) {
                  $scope.showToast(
                    !id_form ? "AJOUT" : "MODIFICATION",
                    `<span class="h4">${message}</span>`,
                    "error"
                  );
                });
              }
            } else {
              $scope.showToast(
                !id_form ? "AJOUT" : "MODIFICATION",
                '<span class="h4">Erreur depuis le serveur, veuillez contacter l\'administrateur</span>',
                "error"
              );
            }
          }
        );
      }
    };



    //--Pour supprimer un élément--//
    $scope.deleteElement = function (type, itemId, action = null) {
      var msg = "Voulez-vous vraiment effectuer cette suppression ?";
      var title = "SUPPRESSION";

      iziToast.question({
        timeout: 0,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 4000,
        title: title,
        message: msg,
        position: "center",
        buttons: [
          [
            '<button class="font-bold btn btn-success" style="color: green!important">Confirmer</button>',
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");

              Init.removeElement(type, itemId).then(
                function (data) {
                  if (data.data && !data.errors) {
                    $scope.showToast(title, "Succès", "success");
                    if (type == "da/documentspecification") {
                      $scope.getelements(
                        "das",
                        null,
                        (filtres = "id:" + $scope.id)
                      );
                    } else {
                      $scope.pageChanged(type);
                    }
                  } else {
                    $scope.showToast(title, data.errors_debug, "error");
                  }
                },
                function (msg) {
                  $scope.showToast(title, msg, "error");
                }
              );
            },
            true,
          ],
          [
            '<button class="btn btn-danger" style="color: red!important">Annuler</button>',
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
          ],
        ],
        onClosing: function (instance, toast, closedBy) { },
        onClosed: function (instance, toast, closedBy) { },
      });
    };

    $scope.desactivElement = function (
      type,
      itemId,
      action = null,
      index = null,
      list = false,
      tab = false
    ) {
      var msg = "";
      var title = "";
      var typeQuery = type;
      var confirmation = true;

      msg =
        $scope.chstat.statut == 1
          ? "Voulez-vous vraiment effectuer cette activation ?"
          : "Voulez-vous vraiment effectuer cette desactivation ?";
      title = $scope.chstat.statut == 1 ? "ACTIVATION" : "DESACTIVATION";

      var send_data = {
        id: $scope.chstat.id,
        status: $scope.chstat.statut,
        substatut: $scope.chstat.substatut,
        commentaire: $("#commentaire_chstat").val(),
        objet: itemId,
        type: type,
      };

      if (confirmation) {
        iziToast.question({
          timeout: 0,
          close: false,
          overlay: true,
          displayMode: "once",
          id: "question",
          zindex: 4000,
          title: title,
          message: msg,
          position: "center",
          buttons: [
            [
              '<button class="font-bold btn btn-success" style="color: green!important">Confirmer</button>',
              function (instance, toast) {
                Init.changeStatut(typeQuery, send_data).then(
                  function (data) {
                    if (data.data && !data.errors) {
                      instance.hide(
                        {
                          transitionOt: "fadeOut",
                        },
                        toast,
                        "button"
                      );

                      $scope.showToast(title, "Réussi", "success");

                      $scope.pageChanged(typeQuery);
                    } else {
                      $scope.showToast(title, data.errors_debug, "error");
                    }
                  },
                  function (msg) {
                    $scope.showToast(title, msg, "error");
                  }
                );
              },
              true,
            ],
            [
              '<button class="btn btn-danger" style="color: red!important">Annuler</button>',
              function (instance, toast) {
                instance.hide({ transitionOut: "fadeOut" }, toast, "button");
              },
              false,
            ],
          ],
          onClosing: function (instance, toast, closedBy) { },
          onClosed: function (instance, toast, closedBy) { },
        });
      } else {
        Init.changeStatut(typeQuery, send_data).then(
          function (data) {
            if (data.data && !data.errors) {
              if (list == false) {
                $scope.pageChanged(type);
                $scope.showToast(title, "Réussi", "success");
              }
            } else {
              $scope.showToast(title, data.errors_debug, "error");
            }
          },
          function (msg) {
            $scope.showToast(title, msg, "error");
          }
        );
      }
    };

    $scope.initNotif = {
      progressBar: true,
      close: true,
      closeOnClick: true,
      timeout: false,
      title: "",
      message: "",
      position: "topRight",
      linkUrl: null,
      onClose: function (instance, toast, closedBy) { },
    };

    // Variables pour le chat
    $scope.chatModalVisible = false;
    $scope.chatRecipient = "Utilisateur"; // Par défaut, ou dynamique selon contexte
    $scope.chatMessages = [];
    $scope.chatInput = "";
    $scope.users = [
      { id: 1, name: "Alice" },
      { id: 2, name: "Bob" },
      { id: 3, name: "Charlie" },
      { id: 4, name: "David" }
    ];

    $scope.mentionSuggestions = [];

    $scope.checkMention = function (event) {
      var value = $("#chatInput").val(); // lire avec jQuery
      var mentionMatch = value.match(/@(\w*)$/);

      if (mentionMatch) {
        var query = mentionMatch[1].toLowerCase();
        $scope.mentionSuggestions = $scope.users.filter(function (u) {
          return u.name.toLowerCase().startsWith(query);
        });
      } else {
        $scope.mentionSuggestions = [];
      }
      $scope.$applyAsync(); // pour rafraîchir AngularJS
    };

    $scope.selectMention = function (user) {
      var currentVal = $("#chatInput").val();
      var newVal = currentVal.replace(/@\w*$/, "@" + user.name + " ");
      $("#chatInput").val(newVal); // mettre à jour l’input
      $scope.mentionSuggestions = [];
    };





    // Ouvrir/fermer modal chat
    $scope.toggleChatModal = function () {
      $scope.chatModalVisible = !$scope.chatModalVisible;
      if ($scope.chatModalVisible) {
        // Ouvrir modal Bootstrap
        var chatModalEl = document.getElementById('chatModal');
        var modal = new bootstrap.Modal(chatModalEl);
        modal.show();

        // Mettre le focus sur l'input
        setTimeout(function () {
          var input = chatModalEl.querySelector('input[type="text"]');
          if (input) input.focus();
        }, 300);
      } else {
        $scope.closeChatModal();
      }
    };

    $scope.closeChatModal = function () {
      $scope.chatModalVisible = false;
      var chatModalEl = document.getElementById('chatModal');
      var modal = bootstrap.Modal.getInstance(chatModalEl);
      if (modal) modal.hide();
    };

    // Envoyer un message
    // Envoyer un message
    $scope.sendMessage = function () {
      var inputVal = $("#chatInput").val().trim(); // récupération avec jQuery

      if (!inputVal) return;

      // Ajouter @ devant le nom du destinataire
      var messageText = "@" + $scope.chatRecipient + " " + inputVal;

      $scope.chatMessages.push({
        sender: "Vous",
        text: messageText,
        date: new Date()
      });

      // Réinitialiser input avec jQuery
      $("#chatInput").val("");

      // Scroll vers le bas
      setTimeout(function () {
        var chatMessagesDiv = $("#chatMessages");
        if (chatMessagesDiv.length) {
          chatMessagesDiv.scrollTop(chatMessagesDiv[0].scrollHeight);
        }
      }, 100);
    };


    $scope.showToast = function (
      title,
      msg,
      type = "success",
      withTimeout = 5000,
      linkUrl = null
    ) {
      $scope.initNotif.timeout = withTimeout;
      if (!(withTimeout > 0)) {
        $scope.initNotif.progressBar = false;
      }
      $scope.initNotif.title = title;
      $scope.initNotif.message = msg;
      $scope.initNotif.linkUrl = linkUrl;

      if (type.indexOf("success") !== -1) {
        iziToast.success($scope.initNotif);
      } else if (type.indexOf("warning") !== -1) {
        iziToast.warning($scope.initNotif);
      } else if (type.indexOf("error") !== -1) {
        iziToast.error($scope.initNotif);
      } else if (type.indexOf("info") !== -1) {
        iziToast.info($scope.initNotif);
      }
      if (!withTimeout) {
        $scope.playAudio();
      }
    };




    $scope.onChangeTSSCOD_0_0_1 = function () {
      let value = $("#TSSCOD_0_0_1_ficheevaluation").val();
      console.log(value, "test");
    }

    $scope.onChangeTSSCOD_0_0_2 = function () {
      let value = $("#TSSCOD_0_0_2_ficheevaluation").val();
      console.log(value, "test");
    }

    // les show modal

    $scope.showModalUpdate = function (
      type,
      itemId,
      optionals = {
        forceChangeForm: false,
        isClone: false,
        transformToType: null,
        itemIdForeign: null,
        jour: null,
      },
      detail = false
    ) {
      $.blockUI();
      // $scope.select2();
      $scope.detail = detail;
      let formatId = "id";

      let listeattributs_filter = [];
      let listeattributs = listofrequests_assoc[type + "s"];

      $scope.redirectPdf = function (identifiant) {
        window.open(`${identifiant}`, "_blank");
      };

      reqwrite = type + "s" + "(" + formatId + ":" + itemId + ")";

      if (optionals.transformToType) {
        tmpType = type;
        type = optionals.transformToType;
      }

      //optimisation
      $scope.showModalAdd(type, { fromUpdate: true }, itemId);

      //optimisation
      //  optionals["fromUpdate"]   = true;
      //  $scope.showModalAdd(type, optionals);

      $scope.update = true;



      Init.getElement(reqwrite, listeattributs, listeattributs_filter).then(
        function (data) {
          let item = data.data[0];
          $scope.item_update = item;

          if (!optionals.isClone && !optionals.transformToType) {
            $("#id_" + type).val(item?.id);
            $("#description_" + type)
              .val(item.description)
              .trigger("change");
            $("#designation_" + type)
              .val(item.designation)
              .trigger("change");
          }

          if (type.indexOf("typemarche") !== -1) {
            $("#code_" + type)
              .val(item.code)
              .trigger("change");


            if (item.type == 1) {
              $("#TSSCOD_0_0_1_ficheevaluation").prop("checked", true);
              $("#TSSCOD_0_0_1_ficheevaluation")
                .val(item.type)
                .trigger("change");
            }
            if (item.type == 2) {
              $("#TSSCOD_0_0_2_ficheevaluation").prop("checked", true);
              $("#TSSCOD_0_0_2_ficheevaluation")
                .val(item.type)
                .trigger("change");
            }

            $scope.dataInTabPane.typemarchedetails_typemarche.data = item.typemarchedetails.map((typemarche) => {
              return {
                id: typemarche.id,
                parcourmarche: typemarche.parcourmarche,
                position: typemarche.position,
                rolesId: typemarche.detailtypemarchedetails.map((detailtypemarche) => {
                  return detailtypemarche.role.id
                }),
                roles: typemarche.detailtypemarchedetails.map((detailtypemarche) => {
                  return detailtypemarche.role
                }),
              };
            }) || [];
          }
          if (type.indexOf("fournisseur") !== -1) {
            $("#score_" + type)
              .val(item.score)
              .trigger("change");
            $("#nom_" + type)
              .val(item.nom)
              .trigger("change")
          }
          if (type.indexOf("chauffeur") !== -1) {
            $("#nom_" + type)
              .val(item.nom)
              .trigger("change");
            $("#adresse_" + type)
              .val(item.adresse)
              .trigger("change");

            $("#email_" + type)
              .val(item.email)
              .trigger("change");

            $("#telephone_" + type)
              .val(item.telephone)
              .trigger("change");
          }

          if (type.indexOf("tonnage") !== -1) {
            $("#tonnage_" + type)
              .val(item.tonnage)
              .trigger("change");
            $("#unite_" + type)
              .val(item.unite_id)
              .trigger("change");

            $("#min_" + type)
              .val(item.min)
              .trigger("change");

            $("#max_" + type)
              .val(item.max)
              .trigger("change");
          }
          if (type.indexOf("vehicule") !== -1) {
            $("#tonnage_" + type)
              .val(item.tonnage_id)
              .trigger("change");

            $("#typevehicule_" + type)
              .val(item.typevehicule_id)
              .trigger("change");

            $("#matricule_" + type)
              .val(item.matricule)
              .trigger("change");

            $("#volume_" + type)
              .val(item.volume)
              .trigger("change");

            $("#marque_" + type)
              .val(item.marque)
              .trigger("change");

            $("#chauffeur_" + type)
              .val(item.chauffeur_id)
              .trigger("change");
          }

          if (type.indexOf("role") !== -1) {
            //update_role
            $("#name_" + type).val(item.name);
            $scope.unChechAllPermissions();
            if (item.isplanning == 1) {
              $("#isplanning_role").val(item.isplanning).trigger("change");
              $("#isplanning_role").prop("checked", true);
            }
            if (item.iscommercial == 1) {
              $("#iscommercial_role").prop("checked", true);
              $("#iscommercial_role")
                .val(item.iscommercial)
                .trigger("change");
            }
            if (item.ischauffeur == 1) {
              $("#ischauffeur_role").prop("checked", true);
              $("#ischauffeur_role").val(item.ischauffeur).trigger("change");
            }
            if (item.isadmin == 1) {
              $("#isadmin_role").prop("checked", true);
              $("#isadmin_role").val(item.isadmin).trigger("change");
            }
            if (item.estautoriser == 1) {
              $("#estautoriser_role").prop("checked", true);
              $("#estautoriser_role")
                .val(item.estautoriser)
                .trigger("change");
            }

            if (item.ischantenne == 1) {
              $("#ischantenne_" + type).prop("checked", true);
              $("#ischantenne_" + type).val(item.ischantenne).trigger("change");
            }

            if (item.auth_mobile == 1) {
              $("#auth_mobile_role").prop("checked", true);
              $("#auth_mobile_role").val(item.auth_mobile).trigger("change");
            }

            $.each(item.permissions, function (keyItem, valueItem) {
              $scope.dataInTabPane.permission_role.data.push(valueItem.id);
              $scope.checkedPermission(valueItem.id);
            });
          }
          else if (type.indexOf("client") !== -1) {
            $("#address_" + type)
              .val(item.address)
              .trigger("change");

            $("#region_" + type)
              .val(item.region)
              .trigger("change");

            $("#district_" + type)
              .val(item.district)
              .trigger("change");


            $("#role_" + type)
              .val(item.user ? item.user.role_id : null)
              .trigger("change");

            $("#login_" + type)
              .val(item.user ? item.user.login : null)
              .trigger("change");

            $("#email_" + type)
              .val(item.user ? item.user.email : null)
              .trigger("change");


            // telfixe
            $("#telfixe_" + type)
              .val(item.telfixe)
              .trigger("change");

            //telmobile

            $("#telmobile_" + type)
              .val(item.telmobile)
              .trigger("change");

            //categorieclient

            $("#categorieclient_" + type)
              .val(item.categorieclient_id)
              .trigger("change");

            // typeclient_client

            $("#typeclient_" + type)
              .val(item.clienttypeclients?.map((item) => item.typeclient_id))
              .trigger("change");


            //typeclient

            $("#typeclient_" + type)
              .val(item.clienttypeclients?.map((item) => item.typeclient_id))
              .trigger("change");

          }
          else if (type.indexOf("pointdevente") !== -1) {
            $("#id_" + type)
              .val(item.id)
              .trigger("change");
            $("#designation_" + type)
              .val(item.designation)
              .trigger("change");
            $("#email_" + type)
              .val(item.email)
              .trigger("change");
            $("#telephone_" + type)
              .val(item.telephone)
              .trigger("change");
            $("#adresse_" + type)
              .val(item.adresse)
              .trigger("change");
            $("#id_pointdevente" + type)
              .val(item.id)
              .trigger("change");
            $("#intitule_" + type)
              .val(item.intitule)
              .trigger("change");

            $("#etat_" + type)
              .val(item.etat)
              .trigger("change");

            $("#ventedirect_" + type)
              .val(item.ventedirect)
              .trigger("change");

            // $("#estdivers_" + type)
            // .val(item.estdivers)
            // .trigger("change");

            if (item.estdivers == 1) {
              $("#estdivers_" + type).val(item.estdivers).trigger("change");
              $("#estdivers_" + type).prop("checked", true);
            }
            // if (item.ventedirect == 1) {
            //   $("#ventedirect_" + type).val(item.ventedirect).trigger("change");
            //   $("#ventedirect_" + type).prop("checked", true);
            // }
            $("#numbcpttier_" + type)
              .val(item.numbcpttier)
              .trigger("change");
            //zone_

            $("#zone_" + type)
              .val(item.zone ? item.zone.id : null)
              .trigger("change");

            $("#client_" + type)
              .val(item.client ? item.client.id : null)
              .trigger("change");


            $("#typepointdevente_" + type)
              .val(item.typepointdevente ? item.typepointdevente.id : null)
              .trigger("change");

            $("#categoriepointdevente_" + type)
              .val(
                item.categoriepointdevente
                  ? item.categoriepointdevente.id
                  : null
              )
              .trigger("change");

            // pdv_image_ img

            $("#pdv_image_" + type)
              .attr("src", item.images ? item.images : item.img_local)
              .trigger("change");

            $("#gps_" + type)
              .val(item.gps)
              .trigger("change");

            // gps_chaine

            $("#gps_chaine_" + type)
              .val(item.gps)
              .trigger("change");

            $("#latitude_" + type)
              .val(item.latitude)
              .trigger("change");

            $("#longitude_" + type)
              .val(item.longitude)
              .trigger("change");

            // $("#client_pointdevente").val(item.clien
          }
          else if (type.indexOf("user") !== -1) {
            $("#id_" + type)
              .val(item.id)
              .trigger("change");
            $("#name_" + type)
              .val(item.name)
              .trigger("change");
            $("#email_" + type)
              .val(item.email)
              .trigger("change");
            $("#role_" + type)
              .val(item.role.id)
              .trigger("change");
            $("#password_" + type)
              .val(item.password)
              .trigger("change");
            $("#confirmpassword_" + type)
              .val(item.password)
              .trigger("change");


            $("#code_" + type)
              .val(item.code)
              .trigger("change");

            $("#compteclient_" + type)
              .val(item.compteclient)
              .trigger("change");

            $("#antenne_" + type)
              .val(item?.antenne_id)
              .trigger("change");

            $("#login_" + type)
              .val(item.login)
              .trigger("change");

            $("#zone_" + type)
              .val(item.zones.map((zone) => zone.id))
              .trigger("change");
          }
          else if (type.indexOf("zone") !== -1) {
            $("#id_" + type)
              .val(item.id)
              .trigger("change");

            //designation_
            $("#designation_" + type)
              .val(item.designation)
              .trigger("change");
            //description

            $("#description_" + type)
              .val(item.descriptions)
              .trigger("change");
            $("#antenne_" + type)
              .val(item.antenne_id)
              .trigger("change");
          }
          else if (type.indexOf("axe") !== -1) {

            $("#province_id_" + type)
              .val(item.province_id)
              .trigger("change");

            $("#tonnage_id_axe").
              val(item.axetonnages.map(
                (at) => at.tonnage?.id
              )).trigger("change");

          }
          else if (type.indexOf("demande") !== -1) {
            $("#id_demande").val(itemId);

            $("#pointdevente_demande")
              .val(item.pointdevente_id)
              .trigger("change");

            $("#commercial_" + type)
              .val(item.commercial_id)
              .trigger("change");

            $("#date_demande").val(item.date).trigger("change");

            $scope.dataInTabPane.demandes_demande.data = item.detailmateriels;
          } else if (type.indexOf("voiture") !== -1) {
            $("#matricule_voiture").val(item.matricule).trigger("change");
            $("#marque_voiture").val(item.marque).trigger("change");
          } else if (type.indexOf("article") !== -1) {
            $("#code_article").val(item?.code).trigger("change");
            $("#prix_article").val(item?.prix).trigger("change");
            // article_image_
            $("#article_image_" + type)
              .attr("src", item.imgurl ? item.imgurl : item.image)
              .trigger("change");

            // imgurl
            $("#categorie_article")
              .val(item?.categorie?.id)
              .trigger("change");

            // imgurl
            $("#unite_article")
              .val(item?.unite?.id)
              .trigger("change");

            // colisage
            $("#colisage_article")
              .val(item?.colisage)
              .trigger("change");

            // articleremisedureedevies

            if (item?.articleremisedureedevies.length > 0)
              $scope.dataInTabPane.remisedureedevie_article.data = item.articleremisedureedevies?.map(
                (item) => {
                  return {
                    id: item.id,
                    moinsnim: item?.remisedureedevie?.moinsnim,
                    moismax: item?.remisedureedevie?.moismax,
                    remise_article: item.remisepourcentage,
                  };
                }
              );



          } else if (type.indexOf("preference") !== -1) {
            $("#nbreutilisateur_preference")
              .val(item.nbreutilisateur)
              .trigger("change");
            $("#ninea_preference").val(item.ninea).trigger("change");
          } else if (type.indexOf("categorie") !== -1) {
            $("#id_" + type)
              .val(item.id)
              .trigger("change");

            //designation_
            $("#designation_" + type)
              .val(item.designation)
              .trigger("change");
            //description

            $("#description_" + type)
              .val(item.description)
              .trigger("change");
          } else if (type.indexOf("modepaiement") !== -1) {
            $("#id_" + type)
              .val(item.id)
              .trigger("change");

            //designation_
            $("#designation_" + type)
              .val(item.designation)
              .trigger("change");
            //description

            $("#desc_" + type)
              .val(item.desc)
              .trigger("change");

            $("#code_" + type)
              .val(item.code)
              .trigger("change");
          } else if (type.indexOf("antenne") !== -1) {
            $("#code_" + type)
              .val(item.code)
              .trigger("change");

          } else if (type.indexOf("unite") !== -1) {
            $("#code_" + type)
              .val(item.code)
              .trigger("change");
            if (item.ispack == 1) {
              $("#ispack_role").prop("checked", true);
              $("#ispack_role").val(item.ispack).trigger("change");
            }
          } else if (type.indexOf("bailleur") !== -1) {
            $("#address_" + type)
              .val(item.address)
              .trigger("change");

            $("#region_" + type)
              .val(item.region)
              .trigger("change");

            $("#district" + type)
              .val(item.district)
              .trigger("change");


            // telfixe
            $("#pays_" + type)
              .val(item.pays)
              .trigger("change");

            //telmobile

            $("#contact_" + type)
              .val(item.contact)
              .trigger("change");

            //categorieclient

            $("#telephone_" + type)
              .val(item.telephone)
              .trigger("change");


            $("#role_" + type)
              .val(item.user ? item.user.role_id : null)
              .trigger("change");

            $("#login_" + type)
              .val(item.user ? item.user.login : null)
              .trigger("change");

            $("#email_" + type)
              .val(item.user ? item.user.email : null)
              .trigger("change");

            $("#designation_" + type)
              .val(item.nom)
              .trigger("change");


          } else if (type.indexOf("documentspecification") !== -1) {


            $("#nature_" + type)
              .val(item.nature)
              .trigger("change");

            $("#typemarche_" + type)
              .val(item.typemarche_id)
              .trigger("change");


            // telfixe
            $("#etape_" + type)
              .val(item.etape)
              .trigger("change");
            $("#section_" + type)
              .val(item.section)
              .trigger("change");


          } else if (type.indexOf("remisedureedevie") !== -1) {




            if (item.typeduree == 1) {
              $("#typeduree_" + type).prop("checked", true);
              $("#typeduree_" + type)
                .val(item.typeduree)
                .trigger("change");
            }

            $("#moinsnim_" + type)
              .val(item.moinsnim)
              .trigger("change");


            // telfixe
            $("#moismax_" + type)
              .val(item.moismax)
              .trigger("change");
            $("#remisepourcentage_" + type)
              .val(item.remisepourcentage)
              .trigger("change");

            $("#remisevaleur_" + type)
              .val(item.remisevaleur)
              .trigger("change");


          } else if (type.indexOf("critere") !== -1) {



            $("#points_" + type)
              .val(item.points)
              .trigger("change");


            $scope.dataInTabPane.echelleevaluations_critere.data = item.echelleevaluations.map((ee) => {
              return {
                id: ee.id,
                designation: ee.designation,
                min: ee.min,
                max: ee.max,
                ordre: ee.ordre,
                points: ee.points,
              };
            }) || [];


          } else if (type.indexOf("ficheevaluation") !== -1) {

            console.log(item.annee, "aanne");

            $("#isactive_ficheevaluation")
              .val(item.isactive)
              .trigger("change");

            $("#modelfiche_ficheevaluation")
              .val(item.modelfiche)
              .trigger("change");

            if (item.isactive == 1) {
              $("#isactive_ficheevaluation").prop("checked", true);
            }

            $("#TSSCOD_0_0_ficheevaluation").val(item.TSSCOD_0_0).trigger("change");


            $scope.dataInTabPane.ficheevaluations_ficheevaluation.data = item.fichecriteres.map((fc) => {
              return { id: fc.id, critere_id: fc.critere_id, ponderation: fc.ponderation, ordre: fc.ordre, designation: fc.critere?.designation };
            }) || [];

            $scope.dataInTabPane.workflows_ficheevaluation.data = item.workflows.map((work) => {
              return { id: work.id, role_id: work.role_id, position: work.position, designation: work.role?.name };
            }) || [];


          }

          // Si le model contient une image dans son formulaire
          if (item && item.image !== undefined) {
            $("#img" + type)
              .val("")
              .attr("required", false)
              .removeClass("required");
            $("#affimg" + type).attr(
              "src",
              item.image ? item.image : imgupload
            );
          }

          $("#modal_add" + type).modal("show");
          setTimeout(function () {
            $.unblockUI();
          }, 1000);
        },
        function (msg) {
          $scope.showToast("", msg, "error");
        }
      );
    };

    $scope.emptyform = function (
      type,
      fromPage = false,
      conserveFilter = false
    ) {
      $scope.orderby = null;
      $scope.inputs = [];
      $scope.radioBtn = null;
      $scope.filters = null;

      $(".ws-number").val("");

      // vider le champ imput file
      $("input[type=file]").val("");

      $(
        "input[id$=" +
        type +
        "], textarea[id$=" +
        type +
        "], select[id$=" +
        type +
        "], button[id$=" +
        type +
        "]"
      ).each(function () {
        if (conserveFilter) {
          if ($(this).attr("id").indexOf("_list_") == -1) {
            $scope.emptyformElement($(this), type);
          }
        } else {
          $scope.emptyformElement($(this), type);
        }
      });

      // On vide le tableau des items ici
      $.each($scope.dataInTabPane, function (keyItem, valueItem) {
        tagType = "_" + type;
        if (keyItem.indexOf(tagType) !== -1) {
          $scope.dataInTabPane[keyItem]["data"] = [];
        }
      });

      $(".checkbox-all").prop("checked", true);
      // Si on clique sur le bouton annuler
      if (fromPage) {
        $scope.pageChanged(type);
      }
    };

    $scope.emptyformElement = function (element, type) {
      $scope.unChechAllPermissions();
      if (element.is("select")) {
        element.val("").change();
      } else if (element.is(":checkbox")) {
        element.prop("checked", false);
        if (element.is("[data-toggle]")) {
          element.bootstrapToggle("destroy").bootstrapToggle();
        }
      } else if (element.is(":radio")) {
        element.prop("checked", false);
      } else if (element.is(":file")) {
        if (element.hasClass("filestyle")) {
          setTimeout(function () {
            element.filestyle("clear");
          }, 200);
        } else {
          getId = element.attr("id").replace(type, "");
          $("#" + getId + type).val("");
          $("#aff" + getId + type).attr("src", imgupload);
        }
      } else if (element.hasClass("datedropper")) {
        element.val(null).trigger("change");
      } else {
        element.val("");
      }
    };



    $scope.currentTitleModal = null;
    $scope.dayFilter = null;

    $scope.showModalAdd = function (
      type,
      optionals = {
        is_file_excel: false,
        title: null,
        fromUpdate: false,
        jour: null,
        data: null,
      },
      itemId = null,
      type_link = null
    ) {
      // $scope.select2();

      $(".1").hide();
      $(".2").hide();
      $(".entreprise").hide();
      $scope.hideButton = true;

      $scope.currentTitleModal = optionals?.title;
      $scope.currentTypeModal = type;
      let fromPage = false;
      let conserveFilter = optionals.fromUpdate ? true : false;

      $scope.emptyform(
        optionals.is_file_excel ? "liste" : type,
        fromPage,
        conserveFilter
      );

      if (type == "document" || type === "annexe") {
        $("#id_" + type).val(itemId).trigger("change");
      }


      if (itemId)
        console.log(itemId, "itemId", type)
      $("#campagne_id_phasedepot").val(itemId).trigger("change");
      $("#programme_id_campagne").val(itemId).trigger("change");
      $("#programme_id_bailleur").val(itemId).trigger("change");

      console.log("test test");
      console.log($scope.articlesoumissionData, "articlesoumissionData");
      if (itemId &&
        type === "lignecommande" &&
        $scope.currentTemplateUrl.indexOf("list-detailcampagne") !== -1
      ) {
        $("#campagne_id_lignecommande").val(itemId).trigger("change")
      } else if (itemId && type === "lignecommande" && $scope.currentTemplateUrl.indexOf("list-detailprogramme") !== -1) {
        $("#programme_id_lignecomma-nde").val(itemId).trigger("change");
      } else if (itemId && type === "contrat" && $scope.currentTemplateUrl.indexOf("list-contractuelle") !== -1) {
        $("#id_contrat").val(itemId).trigger("change");
      } else if (type === "ficheevaluation" && $scope.currentTemplateUrl.indexOf("list-evaluationsfournisseur") !== -1) {
        console.log($scope.selectedannee, "selectedannee");
        $("#annee_ficheevaluation").val($scope.selectedannee).trigger("change");
      } else if (type === "prequalification" && $scope.currentTemplateUrl.indexOf("list-dossiersoumission") !== -1) {
        console.log(optionals.data, "optionals.data");
        $("#article_prequalification").val(optionals.data?.article_id).trigger("change");
        // pays_prequalification
        $("#pays_prequalification").val(optionals.data?.pays_id).trigger("change");
        // Fournisseur_prequalification
        $("#Fournisseur_prequalification").val(optionals.data?.soumission?.fournisseur_id).trigger("change");
        // fabricant_prequalification
        $("#fabricant_prequalification").val(optionals.data?.fabricant_id).trigger("change");
      } else if (type === "statutamm" && $scope.currentTemplateUrl.indexOf("list-dossiersoumission") !== -1) {
        console.log(optionals.data, "optionals.data");
        $("#article_statutamm").val(optionals.data?.article?.code).trigger("change");
        // pays_prequalification
        // Fournisseur_prequalification
        $("#fournisseur_statutamm").val(optionals.data?.soumission?.fournisseur_id).trigger("change");
        // fabricant_prequalification
        $("#labofabricant_statutamm").val(optionals.data?.fabricant_id).trigger("change");
        $("#labotitulaire_statutamm").val(optionals.data?.fabricant_id).trigger("change");
      }
      if (type == 'article') {
        if (itemId) {
          $scope.getelements("remisedureedevies", null, "article_id:" + itemId);
        }

      }

      // $scope.selectedannee




      let idmodal = "#modal_add" + (optionals.is_file_excel ? "list" : type);
      $(idmodal).modal("show");
    };

    $scope.closeModal = function (idmodal) {
      if ($(idmodal).hasClass("modal") && $(idmodal).hasClass("show")) {
        $(idmodal).modal("hide");
      }
    };

    // Partie Planning

    // ici le calendar planning
    $scope.currentMonth = new Date(); // Utilisation du mois en cours
    $scope.selectedDayIntab = null;
    $scope.titre = "ici";
    $scope.selectedDate = null; // Initialisez la propriété selectedDate
    $scope.dateFilter = null;

    // fonction date
    $scope.dateDay = function (index) {
      let date = new Date($("#selectedDate").val() + "T00:00:00");
      const firstDay = date.getDate() - date.getDay() + 1;
      const lastDay = firstDay + parseInt(index);
      const dayDate = new Date(date.getFullYear(), date.getMonth(), lastDay);
      return (
        dayDate.getFullYear() + "-" + (dayDate.getMonth() + 1) + "-" + lastDay
      );
    };
    // fonction date
    $scope.dateDay = function (index) {
      let date = new Date($("#selectedDate").val() + "T00:00:00");

      // Calculer le premier jour de la semaine (lundi)
      const firstDay = date.getDate() - date.getDay() + 1;

      // Calculer la date du jour souhaité en utilisant setDate
      const dayDate = new Date(date);
      dayDate.setDate(firstDay + parseInt(index));

      return (
        dayDate.getFullYear() +
        "-" +
        (dayDate.getMonth() + 1) +
        "-" +
        dayDate.getDate()
      );
    };
    // optimisation (regroupement des deux fonctions dateChanged,initialDta)

    $scope.dateChanged = function () {
      $scope.selectedDate = new Date($("#selectedDate").val() + "T00:00:00");

      // Déterminer le jour de la semaine pour la date sélectionnée
      const dayOfWeek = $scope.selectedDate.getDay();

      // Si c'est dimanche (jour 0), on ajuste pour qu'il soit le dernier jour de la semaine
      const adjustment = dayOfWeek === 0 ? 6 : dayOfWeek - 1;

      // Déterminer le premier jour de la semaine contenant la date sélectionnée
      const startDate = new Date(
        $scope.selectedDate.getFullYear(),
        $scope.selectedDate.getMonth(),
        $scope.selectedDate.getDate() - adjustment
      );

      // Déterminer le dernier jour de la semaine contenant la date sélectionnée
      const endDate = new Date(
        startDate.getFullYear(),
        startDate.getMonth(),
        startDate.getDate() + 6
      );

      // Mettre à jour le titre pour afficher la semaine contenant la date sélectionnée
      $scope.titre = `${startDate.getDate()} au ${endDate.getDate()} du mois de ${$scope.convertMonth(
        startDate.getMonth()
      )}  ${startDate.getFullYear()} `;

      $scope.dateFilter =
        startDate.getFullYear() +
        "-" +
        (startDate.getMonth() + 1) +
        "-" +
        startDate.getDate();
    };

    $scope.initialDta = function () {
      let toDay = new Date();
      const firstDay = toDay.getDate() - toDay.getDay() + 1;
      const lastDay = firstDay + 6;
      const startDate = new Date(
        toDay.getFullYear(),
        toDay.getMonth(),
        firstDay
      );
      const endDate = new Date(toDay.getFullYear(), toDay.getMonth(), lastDay);

      $scope.titre = ` ${startDate.getDate()} au ${endDate.getDate()} du mois de ${$scope.convertMonth(
        toDay.getMonth()
      )}  ${toDay.getFullYear()} `;

      // initialise  selectedDate
      $scope.selectedDate = startDate;
      $scope.dateFilter =
        startDate.getFullYear() +
        "-" +
        (startDate.getMonth() + 1) +
        "-" +
        startDate.getDate();
    };

    $scope.convertMonth = function (index) {
      const moisEnLettre = [
        "Janvier",
        "Février",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Août",
        "Septembre",
        "Octobre",
        "Novembre",
        "Décembre",
      ];
      return moisEnLettre[index];
    };


    // modifierEtValider

    $scope.modifierEtValider = function (commande) {
      console.log(commande, "commabde");
    }

    // fonction select a optimiser aussi

    $scope.getZoneselected = function () {
      $scope.reInitTabPane("zone_planning");
      $("#zone_planning option:selected").each(function () {
        $scope.dataInTabPane["zone_planning"].data.push($(this).val());
      });
    };

    $scope.getSelected = function () {
      $scope.reInitTabPane("pointdeventes_zone");
      $("#pointdeventes_zone option:selected").each(function () {
        $scope.dataInTabPane["pointdeventes_zone"].data.push($(this).val());
      });
    };

    $("#jour_planning").on("change", function () {
      let getId = $(this).attr("id");
      let getValue = $(this).val();
      $scope.reInitTabPane(getId + "s");

      if (getValue && getValue.length > 0) {
        $.each(getValue, function (i, v) {
          // les mettre dans le id : getId
          $scope.dataInTabPane["jour_plannings"]["data"].push(
            $scope.dateDay(v)
          );
        });
      }
    });

    $scope.is_numeric = function (id) {
      if (
        id !== undefined &&
        id !== null &&
        id !== "" &&
        id !== true &&
        id !== false
      ) {
        return !isNaN(parseInt(id));
      }
      return false;
    };

    // methode de recherche

    $scope.addProductIntTab3 = function (tabName, type, id_select, id_qte, id_unite) {
      const productId = document.getElementById(id_select).value;
      const quantityInput = document.getElementById(id_qte).value;
      const uniteInput = $("#unitetarifaire_produit").val();
      console.log(uniteInput, "test");
      if (!productId || !quantityInput || quantityInput <= 0) {
        alert("Veuillez sélectionner un produit et saisir une quantité valide.");
        return;
      }

      const quantity = parseInt(quantityInput);
      const productList = $scope.dataInTabPane[tabName].data;
      console.log(productList, productId, quantity, uniteInput);
      // Vérifier si le produit existe déjà AVEC LA MÊME UNITÉ
      const existingProduct = productList.find(
        (item) => item.id == productId && item.unite_id == uniteInput
      );
      console.log(existingProduct);

      if (existingProduct) {
        // Mettre à jour la quantité du produit existant (même ID et même unité)
        existingProduct.quantity += quantity;
      } else {
        // Ajouter un nouveau produit (soit nouveau ID, soit même ID mais unité différente)
        const selectedProduct = $scope.dataPage[type].find(
          (item) => item.id == productId
        );

        const unite = $scope.dataPage["unites"].find(
          (item) => item.id == uniteInput
        );

        if (selectedProduct) {
          productList.push({
            id: productId,
            designation: selectedProduct.designation,
            quantity: quantity,
            unite_id: uniteInput,
            unite_designation: unite?.designation || "",
          });
        } else {
          alert("Le produit sélectionné n'existe pas.");
        }
      }

      // Réinitialiser les champs de saisie
      document.getElementById("produit_detaillivraison").value = "";
      document.getElementById("quantite_detaillivraison").value = "";
    };

    $scope.addProductIntTab2 = function (tabName, type, id_select, id_qte, id_unite) {
      const productId = document.getElementById(id_select).value;
      const quantityInput = document.getElementById(id_qte).value;
      const uniteInput = document.getElementById(id_unite).value;

      if (!productId || !quantityInput || quantityInput <= 0) {
        alert(
          "Veuillez sélectionner un produit et saisir une quantité valide."
        );
        return;
      }

      const quantity = parseInt(quantityInput);
      const productList = $scope.dataInTabPane[tabName].data;

      // Vérifier si le produit existe déjà
      const existingProduct = productList.find((item) => item.id == productId);

      if (existingProduct) {
        // Mettre à jour la quantité du produit existant
        existingProduct.quantity += quantity;
      } else {
        // Ajouter un nouveau produit
        const selectedProduct = $scope.dataPage[type].find(
          (item) => item.id == productId
        );

        const unite = $scope.dataPage["unites"].find(
          (item) => item.id == uniteInput
        );


        if (selectedProduct) {
          productList.push({
            id: productId,
            designation: selectedProduct.designation,
            quantity: quantity,
            unite_id: uniteInput,
            unite_designation: unite?.designation || "",
          });
        } else {
          alert("Le produit sélectionné n'existe pas.");
        }
      }

      // Réinitialiser les champs de saisie
      document.getElementById("produit_detaillivraison").value = "";
      document.getElementById("quantite_detaillivraison").value = "";
    };

    $scope.addCritereToFiche = function () {
      let critereId = $("#critere_ficheevaluation").val();
      let ponderation = $scope.newCritere.ponderation;
      let ordre = $scope.newCritere.ordre;

      // Vérification des champs
      if (!critereId || !$scope.is_numeric(ponderation) || !$scope.is_numeric(ordre)) {
        $scope.showToast("", "Veuillez remplir tous les champs correctement", "error");
        return;
      }

      // Vérifier si la pondération est valide (entre 0 et 1)
      if (ponderation < 0 || ponderation > 1) {
        $scope.showToast("", "La pondération doit être entre 0 et 1", "error");
        return;
      }

      // Vérifier si le critère existe déjà dans le tableau
      let index = $scope.dataInTabPane.ficheevaluations_ficheevaluation.data.findIndex(
        (item) => item.critere_id == critereId
      );

      if (index != -1) {
        $scope.showToast("", "Ce critère existe déjà dans la fiche", "error");
        return;
      }

      // Vérifier si l'ordre est déjà utilisé
      let ordreExists = $scope.dataInTabPane.ficheevaluations_ficheevaluation.data.findIndex(
        (item) => item.ordre == ordre
      );

      if (ordreExists != -1) {
        $scope.showToast("", "Cet ordre est déjà utilisé", "error");
        return;
      }

      // Récupérer les informations du critère
      let critere = $scope.dataPage['criteres'].find(
        (c) => c.id == critereId
      );

      if (!critere) {
        $scope.showToast("", "Critère non trouvé", "error");
        return;
      }

      // Ajouter le critère dans le tableau
      $scope.dataInTabPane.ficheevaluations_ficheevaluation.data.push({
        critere_id: parseInt(critereId),
        ponderation: parseFloat(ponderation),
        ordre: parseInt(ordre),
        designation: critere.designation // Stocker aussi la désignation pour l'affichage
      });



      $scope.showToast("", "Critère ajouté avec succès", "success");

      // Réinitialiser le modèle
      $scope.newCritere = {
        critere_id: '',
        ponderation: '',
        ordre: ''
      };

      // Réinitialiser le select2
      $("#critere_ficheevaluation").val('').trigger('change');
    };



    $scope.addWorkflowFiche = function () {
      let roleId = $("#role_ficheevaluation").val();
      let position = $("#position_ficheevaluation").val();

      // Vérification des champs
      if (!roleId || !$scope.is_numeric(position)) {
        $scope.showToast("", "Veuillez remplir tous les champs correctement", "error");
        return;
      }

      // Vérifier si le critère existe déjà dans le tableau
      let index = $scope.dataInTabPane.workflows_ficheevaluation.data.findIndex(
        (item) => item.role_id == roleId
      );

      if (index != -1) {
        $scope.showToast("", "Ce critère existe déjà dans la fiche", "error");
        return;
      }

      // Vérifier si l'ordre est déjà utilisé
      let ordreExists = $scope.dataInTabPane.workflows_ficheevaluation.data.findIndex(
        (item) => item.position == position
      );

      if (ordreExists != -1) {
        $scope.showToast("", "Cet ordre est déjà utilisé", "error");
        return;
      }

      // Récupérer les informations du critère
      let role = $scope.dataPage['roles'].find(
        (c) => c.id == roleId
      );

      if (!role) {
        $scope.showToast("", "role non trouvé", "error");
        return;
      }

      // Ajouter le critère dans le tableau
      $scope.dataInTabPane.workflows_ficheevaluation.data.push({
        role_id: parseInt(roleId),
        position: parseFloat(position),
        designation: role.name // Stocker aussi la désignation pour l'affichage
      });

      $scope.showToast("", "Critère ajouté avec succès", "success");

      // Réinitialiser le select2
      $("#position_ficheevaluation").val('').trigger('change');
      $("#role_ficheevaluation").val('').trigger('change')
    };

    $scope.addRemiseDureeVie = function () {
      let remisedureeId = $("#remisedureedevie_article").val();
      let remiseValeur = $("#remise_article").val();

      // Vérification des champs
      if (!$scope.is_numeric(remisedureeId) || !$scope.is_numeric(remiseValeur)) {
        $scope.showToast("", "Veuillez remplir tous les champs correctement", "error");
        return;
      }

      // Vérifier si la remise existe déjà dans le tableau
      let index = $scope.dataInTabPane.remisedureedevie_article.data.findIndex(
        (item) => item.id == remisedureeId
      );

      if (index != -1) {
        $scope.showToast("", "Cette remise existe déjà dans le tableau", "error");
        return;
      }

      // Récupérer la remise sélectionnée
      let remiseduree = $scope.dataPage['remisedureedevies'].find(
        (r) => r.id == remisedureeId
      );

      if (!remiseduree) {
        $scope.showToast("", "Remise non trouvée", "error");
        return;
      }

      // Ajouter la remise dans le tableau
      $scope.dataInTabPane.remisedureedevie_article.data.push({
        id: remiseduree.id,
        moinsnim: remiseduree.moinsnim,
        moismax: remiseduree.moismax,
        remise_article: remiseValeur
      });

      $scope.showToast("", "Remise ajoutée avec succès", "success");

      // Réinitialiser les champs
      $("#remisedureedevie_article").val("").trigger("change");
      $("#remise_article").val("");
    };
    $scope.addElementInDataTabePane = function () {
      let designation = $("#echelle_designation_critere").val();
      let min = $("#min_critere").val();
      let max = $("#max_critere").val();
      let ordre = $("#ordre_critere").val();
      let points = $("#echelle_points_critere").val();

      // Vérification des champs
      if (!designation || !$scope.is_numeric(min) || !$scope.is_numeric(max) || !$scope.is_numeric(ordre) || !$scope.is_numeric(points)) {
        $scope.showToast("", "Veuillez remplir tous les champs correctement", "error");
        return;
      }

      // Vérifier si l'échelle existe déjà dans le tableau (basé sur min/max)
      let index = $scope.dataInTabPane.echelleevaluations_critere.data.findIndex(
        (item) => item.min == min && item.max == max
      );

      if (index != -1) {
        $scope.showToast("", "Cette échelle existe déjà dans le tableau", "error");
        return;
      }

      // Ajouter l'échelle dans le tableau
      $scope.dataInTabPane.echelleevaluations_critere.data.push({
        designation: designation,
        min: parseFloat(min),
        max: parseFloat(max),
        ordre: parseInt(ordre),
        points: parseFloat(points)
      });

      $scope.showToast("", "Échelle ajoutée avec succès", "success");

      // Réinitialiser les champs
      $("#echelle_designation_critere").val("");
      $("#min_critere").val("");
      $("#max_critere").val("");
      $("#ordre_critere").val("");
      $("#echelle_points_critere").val("");
    };
    $scope.addProductIntTab = function (type = null) {
      // Récupérer les valeurs sélectionnées
      let remisedureeId = $("#remisedureedevie_article").val();
      let remiseValeur = $("#remise_article").val();

      // Vérification des champs
      if (!$scope.is_numeric(remisedureeId) || !$scope.is_numeric(remiseValeur)) {
        $scope.showToast("", "Veuillez remplir les champs correctement", "error");
        return;
      }

      // Vérifier si le produit existe déjà dans le tableau
      let index = type
        ? $scope.dataPage["visites"][0].detaillivraisons.findIndex(
          (produit) => produit.remiseduree_id == remisedureeId
        )
        : $scope.dataInTabPane.remisedureedevie_article.data.findIndex(
          (produit) => produit.id == remisedureeId
        );

      if (index != -1) {
        $scope.showToast("", "Cette remise existe déjà dans le tableau", "error");
        return;
      }

      // Récupérer les informations de la remise sélectionnée
      let remiseduree = $scope.dataPage["remisedureedevies"].find(
        (r) => r.id == remisedureeId
      );

      if (!remiseduree) {
        $scope.showToast("", "Remise non trouvée", "error");
        return;
      }

      // Ajouter la remise dans le tableau
      if (type != null) {
        // Cas particulier pour "visites"
        $scope.dataPage["visites"][0].detaillivraisons.push({
          remiseduree_id: remiseduree.id,
          designation: remiseduree.designation ?? "",
          quantite: remiseValeur,
        });
      } else {
        $scope.dataInTabPane.remisedureedevie_article.data.push({
          id: remiseduree.id,
          designation: remiseduree.designation ?? "",
          remise_categorietarifaire: remiseValeur,
          moinsnim: remiseduree.moinsnim,
          moismax: remiseduree.moismax,
        });
      }

      $scope.showToast("", "Remise ajoutée avec succès", "success");

      // Réinitialiser les champs
      $("#remisedureedevie_article").val("").trigger("change");
      $("#remise_article").val("");
    };


    $scope.initialDta();

    //MES VARIABLES
    $scope.submenu = false;
    $scope.Pages = [
      {
        titre: "Admin",
        icon: "fa fa-user-shield",
        parent_id: 2,
        permission: "voir-module-admin",
        parent: [
          {
            titre: "Roles",
            icon: "fa fa-user-tag",
            url: "list-role",
            permission: "liste-role",
          },
          {
            titre: "Utilisateurs",
            icon: "fa fa-users",
            url: "list-user",
            permission: "liste-user",
          },
        ],
      },
      {
        titre: "VISITE",
        icon: "fa fa-map-marked-alt",
        parent_id: 3,
        permission: "voir-module-vente",
        parent: [
          {
            titre: "Oeuvre",
            icon: "fa fa-palette",
            url: "list-oeuvre",
            permission: "liste-oeuvre",
          },
          {
            titre: "horaires",
            url: "list-horaire",
            icon: "fa fa-clock",
            permission: "liste-horaire",
          },
          {
            titre: "Collections",
            icon: "fa fa-layer-group",
            url: "list-collection",
            permission: "liste-collection",
          },
          {
            titre: "Billets",
            icon: "fa fa-ticket-alt",
            url: "list-billet",
            permission: "liste-billet",
          },
          {
            titre: "Tarifs",
            icon: "fa fa-tags",
            url: "list-tarif",
            permission: "liste-tarif",
          }
        ],
      },
      {
        titre: "EVENTS & ACTIVITÉS",
        icon: "fa fa-calendar-alt",
        parent_id: 5,
        permission: "voir-module-evenement",
        parent: [
          {
            titre: "Evenements",
            url: "list-evenement",
            icon: "fa fa-calendar-check",
            permission: "liste-evenement",
          },
          {
            titre: "Expositions",
            url: "list-exposition",
            icon: "fa fa-images",
            permission: "liste-exposition",
          },
          {
            titre: "Activites",
            url: "list-activite",
            icon: "fa fa-running",
            permission: "liste-activite",
          },
          {
            titre: "Horaires",
            url: "list-horaire",
            icon: "fa fa-clock",
            permission: "liste-horaire",
          }
        ],
      },
      {
        titre: "E-BOUTIQUE",
        icon: "fa fa-shopping-cart",
        parent_id: 5,
        permission: "voir-module-evenement",
        parent: [
          {
            titre: "PRODUITS",
            url: "list-produit",
            icon: "fa fa-box",
            permission: "liste-produit",
          },
          {
            titre: "COMMANDES",
            url: "list-commande",
            icon: "fa fa-clipboard-list",
            permission: "liste-commande",
          }
        ],
      },
      {
        titre: "ATELIERS",
        icon: "fa fa-paint-brush",
        parent_id: 5,
        permission: "voir-module-evenement",
        parent: [
          {
            titre: "ATELIERS",
            url: "list-atelier",
            icon: "fa fa-tools",
            permission: "liste-atelier",
          },
          {
            titre: "INSCRIPTIONS",
            url: "list-inscription",
            icon: "fa fa-user-plus",
            permission: "liste-inscription",
          },
        ],
      },
      {
        titre: "PARAMETRAGE",
        icon: "fa fa-cogs",
        parent_id: 5,
        permission: "voir-module-evenement",
        parent: [
          {
            titre: "Quiz",
            url: "list-quiz",
            icon: "fa fa-question-circle",
            permission: "liste-quiz",
          }
        ],
      }
    ];

    // viewcontenloaded
    $scope.$on("$viewContentLoaded", function () {
      $scope.checkPermision = function (perm) {
        var trouve = false;
        let role_id = JSON.parse($scope.userConnected).role_id;
        let permissions = $scope.dataPage["roles"].find(
          (role) => role.id == role_id
        ).permissions;
        permissions.forEach((permission) => {
          if (permission.name == perm) {
            trouve = true;
          }
        });
        return true;
      };
    });

    $scope.openmenu = {};

    $scope.dropmenu = function (id) {
      if ($scope.openmenu[id] === undefined || $scope.openmenu[id] === false) {
        $scope.openmenu[id] = true;
      } else {
        $scope.openmenu[id] = false;
      }
    };
  }
);
