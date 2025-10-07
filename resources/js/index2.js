"use strict";

var logoHeaderContent = $(".sidebar .logo-header").html();
$(".main-header .logo-header").html(logoHeaderContent);

$(document).ready(function () {
  $(".nav-search .input-group > input")
    .focus(function (e) {
      $(this).parents().eq(2).addClass("focus");
    })
    .blur(function (e) {
      $(this).parents().eq(2).removeClass("focus");
    });

  $("#search-nav").on("shown.bs.collapse", function () {
    $(".nav-search .form-control").focus();
  });

  var toggle_sidebar = false,
    toggle_quick_sidebar = false,
    toggle_topbar = false,
    minimize_sidebar = false,
    first_toggle_sidebar = false,
    toggle_page_sidebar = false,
    toggle_overlay_sidebar = false,
    nav_open = 0,
    quick_sidebar_open = 0,
    topbar_open = 0,
    mini_sidebar = 0,
    page_sidebar_open = 0,
    overlay_sidebar_open = 0;

  if (!toggle_sidebar) {
    var toggle = $(".sidenav-toggler");

    toggle.on("click", function () {
      if (nav_open == 1) {
        $("html").removeClass("nav_open");
        toggle.removeClass("toggled");
        nav_open = 0;
      } else {
        $("html").addClass("nav_open");
        toggle.addClass("toggled");
        nav_open = 1;
      }
    });
    toggle_sidebar = true;
  }

  if (!quick_sidebar_open) {
    var toggle = $(".quick-sidebar-toggler");

    toggle.on("click", function () {
      if (nav_open == 1) {
        $("html").removeClass("quick_sidebar_open");
        $(".quick-sidebar-overlay").remove();
        toggle.removeClass("toggled");
        quick_sidebar_open = 0;
      } else {
        $("html").addClass("quick_sidebar_open");
        toggle.addClass("toggled");
        $('<div class="quick-sidebar-overlay"></div>').insertAfter(
          ".quick-sidebar"
        );
        quick_sidebar_open = 1;
      }
    });



    $(".close-quick-sidebar").on("click", function () {
      $("html").removeClass("quick_sidebar_open");
      $(".quick-sidebar-toggler").removeClass("toggled");
      $(".quick-sidebar-overlay").remove();
      quick_sidebar_open = 0;
    });

    quick_sidebar_open = true;
  }

  if (!toggle_topbar) {
    var topbar = $(".topbar-toggler");

    topbar.on("click", function () {
      if (topbar_open == 1) {
        $("html").removeClass("topbar_open");
        topbar.removeClass("toggled");
        topbar_open = 0;
      } else {
        $("html").addClass("topbar_open");
        topbar.addClass("toggled");
        topbar_open = 1;
      }
    });
    toggle_topbar = true;
  }

  if (!minimize_sidebar) {
    var minibutton = $(".toggle-sidebar");
    if ($(".wrapper").hasClass("sidebar_minimize")) {
      minibutton.addClass("toggled");
      minibutton.html('<i class="gg-more-vertical-alt"></i>');
      mini_sidebar = 1;
    }

    minibutton.on("click", function () {
      if (mini_sidebar == 1) {
        $(".wrapper").removeClass("sidebar_minimize");
        minibutton.removeClass("toggled");
        minibutton.html('<i class="gg-menu-right"></i>');
        mini_sidebar = 0;
      } else {
        $(".wrapper").addClass("sidebar_minimize");
        minibutton.addClass("toggled");
        minibutton.html('<i class="gg-more-vertical-alt"></i>');
        mini_sidebar = 1;
      }
      $(window).resize();
    });
    minimize_sidebar = true;
    first_toggle_sidebar = true;
  }

  if (!toggle_page_sidebar) {
    var pageSidebarToggler = $(".page-sidebar-toggler");

    pageSidebarToggler.on("click", function () {
      if (page_sidebar_open == 1) {
        $("html").removeClass("pagesidebar_open");
        pageSidebarToggler.removeClass("toggled");
        page_sidebar_open = 0;
      } else {
        $("html").addClass("pagesidebar_open");
        pageSidebarToggler.addClass("toggled");
        page_sidebar_open = 1;
      }
    });

    var pageSidebarClose = $(".page-sidebar .back");

    pageSidebarClose.on("click", function () {
      $("html").removeClass("pagesidebar_open");
      pageSidebarToggler.removeClass("toggled");
      page_sidebar_open = 0;
    });

    toggle_page_sidebar = true;
  }


  // addClass if nav-item click and has subnav

  $(".nav-item a").on("click", function () {
    if ($(this).parent().find(".collapse").hasClass("show")) {
      $(this).parent().removeClass("submenu");
    } else {
      $(this).parent().addClass("submenu");
    }
  });
});
