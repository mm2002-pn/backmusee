<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <style type="text/css">
        html {
            font-family: Calibri, Arial, Helvetica, sans-serif;
            font-size: 11pt;
            background-color: white
        }

        a.comment-indicator:hover+div.comment {
            background: #ffd;
            position: absolute;
            display: block;
            border: 1px solid black;
            padding: 0.5em
        }

        a.comment-indicator {
            background: red;
            display: inline-block;
            border: 1px solid black;
            width: 0.5em;
            height: 0.5em
        }

        div.comment {
            display: none
        }

        table {
            border-collapse: collapse;
            page-break-after: always
        }

        .gridlines td {
            border: 1px dotted black
        }

        .gridlines th {
            border: 1px dotted black
        }

        .b {
            text-align: center
        }

        .e {
            text-align: center
        }

        .f {
            text-align: right
        }

        .inlineStr {
            text-align: left
        }

        .n {
            text-align: right
        }

        .s {
            text-align: left
        }

        td.style0 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style0 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style1 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style1 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style2 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style2 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style3 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style3 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style4 {
            vertical-align: middle;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style4 {
            vertical-align: middle;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style5 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style5 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style6 {
            vertical-align: middle;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style6 {
            vertical-align: middle;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style7 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style7 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style8 {
            vertical-align: middle;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style8 {
            vertical-align: middle;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style9 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style9 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style10 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style10 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style11 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style11 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style12 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style12 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style13 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style13 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style14 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style14 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style15 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style15 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style16 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 10pt;
            background-color: white
        }

        th.style16 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 10pt;
            background-color: white
        }

        td.style17 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style17 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style18 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style18 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style19 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style19 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style20 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style20 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style21 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style21 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style22 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style22 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style23 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style23 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style24 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style24 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style25 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 9pt;
            background-color: #FFFFFF
        }

        th.style25 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 9pt;
            background-color: #FFFFFF
        }

        td.style26 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        th.style26 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        td.style27 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        th.style27 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        td.style28 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        th.style28 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        td.style29 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        th.style29 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        td.style30 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style30 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style31 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        th.style31 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        td.style32 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style32 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style33 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style33 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style34 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style34 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style35 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style35 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style36 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        th.style36 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        td.style37 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        th.style37 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        td.style38 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        th.style38 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        td.style39 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style39 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style40 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style40 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style41 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style41 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style42 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style42 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style43 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style43 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style44 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        th.style44 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        td.style45 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        th.style45 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        td.style46 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        th.style46 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        td.style47 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style47 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style48 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style48 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style49 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style49 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style50 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style50 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style51 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style51 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style52 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        th.style52 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #C5E0B3
        }

        td.style53 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style53 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style54 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style54 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style55 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        th.style55 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        td.style56 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        th.style56 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        td.style57 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        th.style57 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        td.style58 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 10pt;
            background-color: white
        }

        th.style58 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 10pt;
            background-color: white
        }

        td.style59 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 10pt;
            background-color: white
        }

        th.style59 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 10pt;
            background-color: white
        }

        td.style60 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style60 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style61 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style61 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style62 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style62 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style63 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style63 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style64 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style64 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style65 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style65 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style66 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style66 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style67 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style67 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style68 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style68 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style69 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style69 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style70 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style70 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style71 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style71 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style72 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style72 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style73 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style73 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style74 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style74 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style75 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style75 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style76 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style76 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style77 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style77 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style78 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style78 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #FF0000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style79 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style79 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style80 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style80 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style81 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        th.style81 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: #D8D8D8
        }

        td.style82 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        th.style82 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        td.style83 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style83 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style84 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            font-style: italic;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #000000
        }

        th.style84 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            font-style: italic;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #000000
        }

        td.style85 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style85 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style86 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style86 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style87 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        th.style87 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        td.style88 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        th.style88 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        td.style89 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        th.style89 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        td.style90 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 26pt;
            background-color: #FFFFFF
        }

        th.style90 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 26pt;
            background-color: #FFFFFF
        }

        td.style91 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 26pt;
            background-color: #FFFFFF
        }

        th.style91 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 26pt;
            background-color: #FFFFFF
        }

        td.style92 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style92 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style93 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: 1px solid #FFFFFF !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style93 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: 1px solid #FFFFFF !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style94 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style94 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style95 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: none #000000;
            border-right: 1px solid #FFFFFF !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style95 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: none #000000;
            border-right: 1px solid #FFFFFF !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style96 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style96 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style97 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style97 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style98 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style98 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style99 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style99 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style100 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style100 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style101 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style101 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style102 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        th.style102 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        td.style103 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        th.style103 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        td.style104 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        th.style104 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        td.style105 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        th.style105 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D0CECE
        }

        td.style106 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        th.style106 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        td.style107 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style107 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style108 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style108 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style109 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style109 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style110 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style110 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style111 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style111 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style112 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        th.style112 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        td.style113 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        th.style113 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FBE4D5
        }

        td.style114 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style114 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style115 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FBE4D5
        }

        th.style115 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FBE4D5
        }

        td.style116 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style116 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style117 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        th.style117 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        td.style118 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        th.style118 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 11pt;
            background-color: #FFFFFF
        }

        td.style119 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style119 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style120 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        th.style120 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 18pt;
            background-color: #FFFFFF
        }

        td.style121 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        th.style121 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: #FFFFFF
        }

        td.style122 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style122 {
            vertical-align: middle;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style123 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style123 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style124 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style124 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style125 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style125 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style126 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: white
        }

        th.style126 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 14pt;
            background-color: white
        }

        td.style127 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style127 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style128 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style128 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style129 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style129 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style130 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style130 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style131 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style131 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style132 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style132 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style133 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style133 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style134 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style134 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style135 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            font-style: italic;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #000000
        }

        th.style135 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            font-style: italic;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #000000
        }

        td.style136 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style136 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style137 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style137 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style138 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style138 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style139 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style139 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style140 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style140 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style141 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D8D8D8
        }

        th.style141 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #D8D8D8
        }

        td.style142 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style142 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style143 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style143 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style144 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style144 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style145 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style145 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style146 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style146 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style147 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style147 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style148 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style148 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style149 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style149 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style150 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style150 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style151 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: white
        }

        th.style151 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: white
        }

        td.style152 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style152 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style153 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style153 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style154 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style154 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style155 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style155 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style156 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style156 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style157 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style157 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style158 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style158 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style159 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style159 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style160 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style160 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style161 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style161 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style162 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style162 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style163 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style163 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style164 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style164 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style165 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style165 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style166 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style166 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style167 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style167 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style168 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style168 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style169 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style169 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style170 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style170 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style171 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style171 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style172 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #FFFFFF !important;
            border-right: none #000000;
            font-weight: bold;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #000000
        }

        th.style172 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #FFFFFF !important;
            border-right: none #000000;
            font-weight: bold;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #000000
        }

        td.style173 {
            vertical-align: bottom;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style173 {
            vertical-align: bottom;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style174 {
            vertical-align: bottom;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #FFFFFF !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style174 {
            vertical-align: bottom;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #FFFFFF !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style175 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style175 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style176 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style176 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style177 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style177 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style178 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style178 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style179 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #FFFFFF !important;
            border-right: none #000000;
            font-weight: bold;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #000000
        }

        th.style179 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #FFFFFF !important;
            border-right: none #000000;
            font-weight: bold;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #000000
        }

        td.style180 {
            vertical-align: bottom;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style180 {
            vertical-align: bottom;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style181 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style181 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style182 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style182 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style183 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style183 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style184 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        th.style184 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        td.style185 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style185 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style186 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #DEEAF6
        }

        th.style186 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #DEEAF6
        }

        td.style187 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style187 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style188 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #DEEAF6
        }

        th.style188 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #DEEAF6
        }

        td.style189 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style189 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style190 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style190 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style191 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style191 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style192 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style192 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style193 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style193 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style194 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style194 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style195 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style195 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style196 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        th.style196 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        td.style197 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style197 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style198 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style198 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style199 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 14pt;
            background-color: white
        }

        th.style199 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 14pt;
            background-color: white
        }

        td.style200 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style200 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style201 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style201 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style202 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style202 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style203 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style203 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style204 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style204 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style205 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 14pt;
            background-color: white
        }

        th.style205 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Phinster';
            font-size: 14pt;
            background-color: white
        }

        td.style206 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style206 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style207 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        th.style207 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Phinster';
            font-size: 11pt;
            background-color: white
        }

        td.style208 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style208 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style209 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style209 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style210 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            font-style: italic;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #000000
        }

        th.style210 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            font-style: italic;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #000000
        }

        td.style211 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style211 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style212 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style212 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style213 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style213 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style214 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style214 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style215 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style215 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style216 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style216 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style217 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style217 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style218 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style218 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style219 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #FFFFFF !important;
            border-right: none #000000;
            font-weight: bold;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #000000
        }

        th.style219 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #FFFFFF !important;
            border-right: none #000000;
            font-weight: bold;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #000000
        }

        td.style220 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style220 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style221 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style221 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style222 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style222 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style223 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style223 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style224 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        th.style224 {
            vertical-align: middle;
            text-align: left;
            padding-left: 0px;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 24pt;
            background-color: #FFFFFF
        }

        td.style225 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style225 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style226 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style226 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style227 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style227 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style228 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style228 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style229 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style229 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style230 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style230 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style231 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style231 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style232 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style232 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style233 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: white
        }

        th.style233 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: white
        }

        td.style234 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #000000
        }

        th.style234 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #FFFFFF !important;
            border-top: 2px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #FFFFFF;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #000000
        }

        td.style235 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style235 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style236 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style236 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 2px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style237 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style237 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style238 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style238 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style239 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style239 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #FFFFFF !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style240 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style240 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style241 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style241 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style242 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        th.style242 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        td.style243 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style243 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style244 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style244 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style245 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        th.style245 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        td.style246 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style246 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style247 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style247 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style248 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style248 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style249 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style249 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style250 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style250 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style251 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        th.style251 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #C5E0B3
        }

        td.style252 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style252 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style253 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style253 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style254 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style254 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style255 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style255 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style256 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style256 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style257 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style257 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style258 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style258 {
            vertical-align: bottom;
            border-bottom: 2px solid #000000 !important;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style259 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #DEEAF6
        }

        th.style259 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #DEEAF6
        }

        td.style260 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        th.style260 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #FFFFFF
        }

        td.style261 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style261 {
            vertical-align: bottom;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: none #000000;
            border-right: 2px solid #000000 !important;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style262 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #DEEAF6
        }

        th.style262 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: none #000000;
            color: #000000;
            font-family: 'Century Gothic';
            font-size: 16pt;
            background-color: #DEEAF6
        }

        table.sheet0 col.col0 {
            width: 42.69999951pt
        }

        table.sheet0 col.col1 {
            width: 160.63333149pt
        }

        table.sheet0 col.col2 {
            width: 31.17777742pt
        }

        table.sheet0 col.col3 {
            width: 83.36666571pt
        }

        table.sheet0 col.col4 {
            width: 71.84444362pt
        }

        table.sheet0 col.col5 {
            width: 23.72222195pt
        }

        table.sheet0 col.col6 {
            width: 23.72222195pt
        }

        table.sheet0 col.col7 {
            width: 23.72222195pt
        }

        table.sheet0 col.col8 {
            width: 23.72222195pt
        }

        table.sheet0 col.col9 {
            width: 23.72222195pt
        }

        table.sheet0 col.col10 {
            width: 77.26666578pt
        }

        table.sheet0 col.col11 {
            width: 31.85555519pt
        }

        table.sheet0 col.col12 {
            width: 19.65555533pt
        }

        table.sheet0 col.col13 {
            width: 21.68888864pt
        }

        table.sheet0 col.col14 {
            width: 35.92222181pt
        }

        table.sheet0 col.col15 {
            width: 19.65555533pt
        }

        table.sheet0 col.col16 {
            width: 19.65555533pt
        }

        table.sheet0 col.col17 {
            width: 19.65555533pt
        }

        table.sheet0 col.col18 {
            width: 27.78888857pt
        }

        table.sheet0 col.col19 {
            width: 27.78888857pt
        }

        table.sheet0 col.col20 {
            width: 19.65555533pt
        }

        table.sheet0 col.col21 {
            width: 21.68888864pt
        }

        table.sheet0 col.col22 {
            width: 21.68888864pt
        }

        table.sheet0 col.col23 {
            width: 18.97777756pt
        }

        table.sheet0 col.col24 {
            width: 26.43333303pt
        }

        table.sheet0 col.col25 {
            width: 21.68888864pt
        }

        table.sheet0 col.col26 {
            width: 23.04444418pt
        }

        table.sheet0 col.col27 {
            width: 23.04444418pt
        }

        table.sheet0 col.col28 {
            width: 23.04444418pt
        }

        table.sheet0 col.col29 {
            width: 31.85555519pt
        }

        table.sheet0 col.col30 {
            width: 18.97777756pt
        }

        table.sheet0 col.col31 {
            width: 20.3333331pt
        }

        table.sheet0 col.col32 {
            width: 33.8888885pt
        }

        table.sheet0 col.col33 {
            width: 23.04444418pt
        }

        table.sheet0 col.col34 {
            width: 23.04444418pt
        }

        table.sheet0 col.col35 {
            width: 31.17777742pt
        }

        table.sheet0 col.col36 {
            width: 27.78888857pt
        }

        table.sheet0 col.col37 {
            width: 27.78888857pt
        }

        table.sheet0 col.col38 {
            width: 23.04444418pt
        }

        table.sheet0 col.col39 {
            width: 23.04444418pt
        }

        table.sheet0 col.col40 {
            width: 20.3333331pt
        }

        table.sheet0 col.col41 {
            width: 23.04444418pt
        }

        table.sheet0 col.col42 {
            width: 20.3333331pt
        }

        table.sheet0 col.col43 {
            width: 23.04444418pt
        }

        table.sheet0 col.col44 {
            width: 23.04444418pt
        }

        table.sheet0 col.col45 {
            width: 23.04444418pt
        }

        table.sheet0 col.col46 {
            width: 21.68888864pt
        }

        table.sheet0 col.col47 {
            width: 23.04444418pt
        }

        table.sheet0 col.col48 {
            width: 23.04444418pt
        }

        table.sheet0 col.col49 {
            width: 23.04444418pt
        }

        table.sheet0 col.col50 {
            width: 27.78888857pt
        }

        table.sheet0 col.col51 {
            width: 27.78888857pt
        }

        table.sheet0 col.col52 {
            width: 46.08888836pt
        }

        table.sheet0 col.col53 {
            width: 53.54444383pt
        }

        table.sheet0 col.col54 {
            width: 71.16666585pt
        }

        table.sheet0 col.col55 {
            width: 210.1111087pt
        }

        table.sheet0 col.col56 {
            width: 97.59999888pt
        }

        table.sheet0 tr {
            height: 15pt
        }

        table.sheet0 tr.row0 {
            height: 16.5pt
        }

        table.sheet0 tr.row1 {
            height: 45.75pt
        }

        table.sheet0 tr.row2 {
            height: 40.5pt
        }

        table.sheet0 tr.row3 {
            height: 40.5pt
        }

        table.sheet0 tr.row4 {
            height: 32.25pt
        }

        table.sheet0 tr.row5 {
            height: 39pt
        }

        table.sheet0 tr.row6 {
            height: 39pt
        }

        table.sheet0 tr.row7 {
            height: 33pt
        }

        table.sheet0 tr.row8 {
            height: 39pt
        }

        table.sheet0 tr.row9 {
            height: 15pt
        }

        table.sheet0 tr.row10 {
            height: 325.5pt
        }

        table.sheet0 tr.row11 {
            height: 16.5pt
        }

        table.sheet0 tr.row12 {
            height: 21.75pt
        }

        table.sheet0 tr.row13 {
            height: 21.75pt
        }

        table.sheet0 tr.row14 {
            height: 16.5pt
        }

        table.sheet0 tr.row15 {
            height: 19.5pt
        }

        table.sheet0 tr.row16 {
            height: 19.5pt
        }

        table.sheet0 tr.row17 {
            height: 19.5pt
        }

        table.sheet0 tr.row18 {
            height: 19.5pt
        }

        table.sheet0 tr.row19 {
            height: 19.5pt
        }

        table.sheet0 tr.row20 {
            height: 19.5pt
        }

        table.sheet0 tr.row21 {
            height: 19.5pt
        }

        table.sheet0 tr.row22 {
            height: 19.5pt
        }

        table.sheet0 tr.row23 {
            height: 19.5pt
        }

        table.sheet0 tr.row24 {
            height: 19.5pt
        }

        table.sheet0 tr.row25 {
            height: 19.5pt
        }

        table.sheet0 tr.row26 {
            height: 19.5pt
        }

        table.sheet0 tr.row27 {
            height: 19.5pt
        }

        table.sheet0 tr.row28 {
            height: 19.5pt
        }

        table.sheet0 tr.row29 {
            height: 19.5pt
        }

        table.sheet0 tr.row30 {
            height: 19.5pt
        }

        table.sheet0 tr.row31 {
            height: 19.5pt
        }

        table.sheet0 tr.row32 {
            height: 19.5pt
        }

        table.sheet0 tr.row33 {
            height: 19.5pt
        }

        table.sheet0 tr.row34 {
            height: 19.5pt
        }

        table.sheet0 tr.row35 {
            height: 19.5pt
        }

        table.sheet0 tr.row36 {
            height: 19.5pt
        }

        table.sheet0 tr.row37 {
            height: 19.5pt
        }

        table.sheet0 tr.row38 {
            height: 19.5pt
        }

        table.sheet0 tr.row39 {
            height: 19.5pt
        }

        table.sheet0 tr.row40 {
            height: 19.5pt
        }

        table.sheet0 tr.row41 {
            height: 19.5pt
        }

        table.sheet0 tr.row42 {
            height: 19.5pt
        }

        table.sheet0 tr.row43 {
            height: 19.5pt
        }

        table.sheet0 tr.row44 {
            height: 19.5pt
        }

        table.sheet0 tr.row45 {
            height: 19.5pt
        }

        table.sheet0 tr.row46 {
            height: 19.5pt
        }

        table.sheet0 tr.row47 {
            height: 19.5pt
        }

        table.sheet0 tr.row48 {
            height: 19.5pt
        }

        table.sheet0 tr.row49 {
            height: 19.5pt
        }

        table.sheet0 tr.row50 {
            height: 19.5pt
        }

        table.sheet0 tr.row51 {
            height: 19.5pt
        }

        table.sheet0 tr.row52 {
            height: 19.5pt
        }

        table.sheet0 tr.row53 {
            height: 19.5pt
        }

        table.sheet0 tr.row54 {
            height: 19.5pt
        }

        table.sheet0 tr.row55 {
            height: 19.5pt
        }

        table.sheet0 tr.row56 {
            height: 19.5pt
        }

        table.sheet0 tr.row57 {
            height: 19.5pt
        }

        table.sheet0 tr.row58 {
            height: 19.5pt
        }

        table.sheet0 tr.row59 {
            height: 19.5pt
        }

        table.sheet0 tr.row60 {
            height: 19.5pt
        }

        table.sheet0 tr.row61 {
            height: 19.5pt
        }

        table.sheet0 tr.row62 {
            height: 16.5pt
        }

        table.sheet0 tr.row63 {
            height: 16.5pt
        }

        table.sheet0 tr.row64 {
            height: 16.5pt
        }

        table.sheet0 tr.row65 {
            height: 16.5pt
        }

        table.sheet0 tr.row66 {
            height: 16.5pt
        }

        table.sheet0 tr.row67 {
            height: 16.5pt
        }

        table.sheet0 tr.row68 {
            height: 16.5pt
        }

        table.sheet0 tr.row69 {
            height: 16.5pt
        }

        table.sheet0 tr.row70 {
            height: 16.5pt
        }

        table.sheet0 tr.row71 {
            height: 16.5pt
        }

        table.sheet0 tr.row72 {
            height: 16.5pt
        }

        table.sheet0 tr.row73 {
            height: 16.5pt
        }

        table.sheet0 tr.row74 {
            height: 16.5pt
        }

        table.sheet0 tr.row75 {
            height: 16.5pt
        }

        table.sheet0 tr.row76 {
            height: 16.5pt
        }

        table.sheet0 tr.row77 {
            height: 16.5pt
        }

        table.sheet0 tr.row78 {
            height: 16.5pt
        }

        table.sheet0 tr.row79 {
            height: 16.5pt
        }

        table.sheet0 tr.row80 {
            height: 16.5pt
        }

        table.sheet0 tr.row81 {
            height: 16.5pt
        }

        table.sheet0 tr.row82 {
            height: 16.5pt
        }

        table.sheet0 tr.row83 {
            height: 16.5pt
        }

        table.sheet0 tr.row84 {
            height: 16.5pt
        }

        table.sheet0 tr.row85 {
            height: 16.5pt
        }

        table.sheet0 tr.row86 {
            height: 16.5pt
        }

        table.sheet0 tr.row87 {
            height: 16.5pt
        }

        table.sheet0 tr.row88 {
            height: 16.5pt
        }

        table.sheet0 tr.row89 {
            height: 16.5pt
        }

        table.sheet0 tr.row90 {
            height: 16.5pt
        }

        table.sheet0 tr.row91 {
            height: 16.5pt
        }

        table.sheet0 tr.row92 {
            height: 16.5pt
        }

        table.sheet0 tr.row93 {
            height: 16.5pt
        }

        table.sheet0 tr.row94 {
            height: 16.5pt
        }

        table.sheet0 tr.row95 {
            height: 16.5pt
        }

        table.sheet0 tr.row96 {
            height: 16.5pt
        }

        table.sheet0 tr.row97 {
            height: 16.5pt
        }

        table.sheet0 tr.row98 {
            height: 16.5pt
        }

        table.sheet0 tr.row99 {
            height: 16.5pt
        }

        table.sheet0 tr.row100 {
            height: 16.5pt
        }

        table.sheet0 tr.row101 {
            height: 16.5pt
        }

        table.sheet0 tr.row102 {
            height: 16.5pt
        }

        table.sheet0 tr.row103 {
            height: 16.5pt
        }

        table.sheet0 tr.row104 {
            height: 16.5pt
        }

        table.sheet0 tr.row105 {
            height: 16.5pt
        }

        table.sheet0 tr.row106 {
            height: 16.5pt
        }

        table.sheet0 tr.row107 {
            height: 16.5pt
        }

        table.sheet0 tr.row108 {
            height: 16.5pt
        }

        table.sheet0 tr.row109 {
            height: 16.5pt
        }

        table.sheet0 tr.row110 {
            height: 16.5pt
        }

        table.sheet0 tr.row111 {
            height: 16.5pt
        }

        table.sheet0 tr.row112 {
            height: 16.5pt
        }

        table.sheet0 tr.row113 {
            height: 16.5pt
        }

        table.sheet0 tr.row114 {
            height: 16.5pt
        }

        table.sheet0 tr.row115 {
            height: 16.5pt
        }

        table.sheet0 tr.row116 {
            height: 16.5pt
        }

        table.sheet0 tr.row117 {
            height: 16.5pt
        }

        table.sheet0 tr.row118 {
            height: 16.5pt
        }

        table.sheet0 tr.row119 {
            height: 16.5pt
        }

        table.sheet0 tr.row120 {
            height: 16.5pt
        }

        table.sheet0 tr.row121 {
            height: 16.5pt
        }

        table.sheet0 tr.row122 {
            height: 16.5pt
        }

        table.sheet0 tr.row123 {
            height: 16.5pt
        }

        table.sheet0 tr.row124 {
            height: 16.5pt
        }

        table.sheet0 tr.row125 {
            height: 16.5pt
        }

        table.sheet0 tr.row126 {
            height: 16.5pt
        }

        table.sheet0 tr.row127 {
            height: 16.5pt
        }

        table.sheet0 tr.row128 {
            height: 16.5pt
        }

        table.sheet0 tr.row129 {
            height: 16.5pt
        }

        table.sheet0 tr.row130 {
            height: 16.5pt
        }

        table.sheet0 tr.row131 {
            height: 16.5pt
        }

        table.sheet0 tr.row132 {
            height: 16.5pt
        }

        table.sheet0 tr.row133 {
            height: 16.5pt
        }

        table.sheet0 tr.row134 {
            height: 16.5pt
        }

        table.sheet0 tr.row135 {
            height: 16.5pt
        }

        table.sheet0 tr.row136 {
            height: 16.5pt
        }

        table.sheet0 tr.row137 {
            height: 16.5pt
        }

        table.sheet0 tr.row138 {
            height: 16.5pt
        }

        table.sheet0 tr.row139 {
            height: 16.5pt
        }

        table.sheet0 tr.row140 {
            height: 16.5pt
        }

        table.sheet0 tr.row141 {
            height: 16.5pt
        }

        table.sheet0 tr.row142 {
            height: 16.5pt
        }

        table.sheet0 tr.row143 {
            height: 16.5pt
        }

        table.sheet0 tr.row144 {
            height: 16.5pt
        }

        table.sheet0 tr.row145 {
            height: 16.5pt
        }

        table.sheet0 tr.row146 {
            height: 16.5pt
        }

        table.sheet0 tr.row147 {
            height: 16.5pt
        }

        table.sheet0 tr.row148 {
            height: 16.5pt
        }

        table.sheet0 tr.row149 {
            height: 16.5pt
        }

        table.sheet0 tr.row150 {
            height: 16.5pt
        }

        table.sheet0 tr.row151 {
            height: 16.5pt
        }

        table.sheet0 tr.row152 {
            height: 16.5pt
        }

        table.sheet0 tr.row153 {
            height: 16.5pt
        }

        table.sheet0 tr.row154 {
            height: 16.5pt
        }

        table.sheet0 tr.row155 {
            height: 16.5pt
        }

        table.sheet0 tr.row156 {
            height: 16.5pt
        }

        table.sheet0 tr.row157 {
            height: 16.5pt
        }

        table.sheet0 tr.row158 {
            height: 16.5pt
        }

        table.sheet0 tr.row159 {
            height: 16.5pt
        }

        table.sheet0 tr.row160 {
            height: 16.5pt
        }

        table.sheet0 tr.row161 {
            height: 16.5pt
        }

        table.sheet0 tr.row162 {
            height: 16.5pt
        }

        table.sheet0 tr.row163 {
            height: 16.5pt
        }

        table.sheet0 tr.row164 {
            height: 16.5pt
        }

        table.sheet0 tr.row165 {
            height: 16.5pt
        }

        table.sheet0 tr.row166 {
            height: 16.5pt
        }

        table.sheet0 tr.row167 {
            height: 16.5pt
        }

        table.sheet0 tr.row168 {
            height: 16.5pt
        }

        table.sheet0 tr.row169 {
            height: 16.5pt
        }

        table.sheet0 tr.row170 {
            height: 16.5pt
        }

        table.sheet0 tr.row171 {
            height: 16.5pt
        }

        table.sheet0 tr.row172 {
            height: 16.5pt
        }

        table.sheet0 tr.row173 {
            height: 16.5pt
        }

        table.sheet0 tr.row174 {
            height: 16.5pt
        }

        table.sheet0 tr.row175 {
            height: 16.5pt
        }

        table.sheet0 tr.row176 {
            height: 16.5pt
        }

        table.sheet0 tr.row177 {
            height: 16.5pt
        }

        table.sheet0 tr.row178 {
            height: 16.5pt
        }

        table.sheet0 tr.row179 {
            height: 16.5pt
        }

        table.sheet0 tr.row180 {
            height: 16.5pt
        }

        table.sheet0 tr.row181 {
            height: 16.5pt
        }

        table.sheet0 tr.row182 {
            height: 16.5pt
        }

        table.sheet0 tr.row183 {
            height: 16.5pt
        }

        table.sheet0 tr.row184 {
            height: 16.5pt
        }

        table.sheet0 tr.row185 {
            height: 16.5pt
        }

        table.sheet0 tr.row186 {
            height: 16.5pt
        }

        table.sheet0 tr.row187 {
            height: 16.5pt
        }

        table.sheet0 tr.row188 {
            height: 16.5pt
        }

        table.sheet0 tr.row189 {
            height: 16.5pt
        }

        table.sheet0 tr.row190 {
            height: 16.5pt
        }

        table.sheet0 tr.row191 {
            height: 16.5pt
        }

        table.sheet0 tr.row192 {
            height: 16.5pt
        }

        table.sheet0 tr.row193 {
            height: 16.5pt
        }

        table.sheet0 tr.row194 {
            height: 16.5pt
        }

        table.sheet0 tr.row195 {
            height: 16.5pt
        }

        table.sheet0 tr.row196 {
            height: 16.5pt
        }

        table.sheet0 tr.row197 {
            height: 16.5pt
        }

        table.sheet0 tr.row198 {
            height: 16.5pt
        }

        table.sheet0 tr.row199 {
            height: 16.5pt
        }

        table.sheet0 tr.row200 {
            height: 16.5pt
        }

        table.sheet0 tr.row201 {
            height: 16.5pt
        }

        table.sheet0 tr.row202 {
            height: 16.5pt
        }

        table.sheet0 tr.row203 {
            height: 16.5pt
        }

        table.sheet0 tr.row204 {
            height: 16.5pt
        }

        table.sheet0 tr.row205 {
            height: 16.5pt
        }

        table.sheet0 tr.row206 {
            height: 16.5pt
        }

        table.sheet0 tr.row207 {
            height: 16.5pt
        }

        table.sheet0 tr.row208 {
            height: 16.5pt
        }

        table.sheet0 tr.row209 {
            height: 16.5pt
        }

        table.sheet0 tr.row210 {
            height: 16.5pt
        }

        table.sheet0 tr.row211 {
            height: 16.5pt
        }

        table.sheet0 tr.row212 {
            height: 16.5pt
        }

        table.sheet0 tr.row213 {
            height: 16.5pt
        }

        table.sheet0 tr.row214 {
            height: 16.5pt
        }

        table.sheet0 tr.row215 {
            height: 16.5pt
        }

        table.sheet0 tr.row216 {
            height: 16.5pt
        }

        table.sheet0 tr.row217 {
            height: 16.5pt
        }

        table.sheet0 tr.row218 {
            height: 16.5pt
        }

        table.sheet0 tr.row219 {
            height: 16.5pt
        }

        table.sheet0 tr.row220 {
            height: 16.5pt
        }

        table.sheet0 tr.row221 {
            height: 16.5pt
        }

        table.sheet0 tr.row222 {
            height: 16.5pt
        }

        table.sheet0 tr.row223 {
            height: 16.5pt
        }

        table.sheet0 tr.row224 {
            height: 16.5pt
        }

        table.sheet0 tr.row225 {
            height: 16.5pt
        }

        table.sheet0 tr.row226 {
            height: 16.5pt
        }

        table.sheet0 tr.row227 {
            height: 16.5pt
        }

        table.sheet0 tr.row228 {
            height: 16.5pt
        }

        table.sheet0 tr.row229 {
            height: 16.5pt
        }

        table.sheet0 tr.row230 {
            height: 16.5pt
        }

        table.sheet0 tr.row231 {
            height: 16.5pt
        }

        table.sheet0 tr.row232 {
            height: 16.5pt
        }

        table.sheet0 tr.row233 {
            height: 16.5pt
        }

        table.sheet0 tr.row234 {
            height: 16.5pt
        }

        table.sheet0 tr.row235 {
            height: 16.5pt
        }

        table.sheet0 tr.row236 {
            height: 16.5pt
        }

        table.sheet0 tr.row237 {
            height: 16.5pt
        }

        table.sheet0 tr.row238 {
            height: 16.5pt
        }

        table.sheet0 tr.row239 {
            height: 16.5pt
        }

        table.sheet0 tr.row240 {
            height: 16.5pt
        }

        table.sheet0 tr.row241 {
            height: 16.5pt
        }

        table.sheet0 tr.row242 {
            height: 16.5pt
        }

        table.sheet0 tr.row243 {
            height: 16.5pt
        }

        table.sheet0 tr.row244 {
            height: 16.5pt
        }

        table.sheet0 tr.row245 {
            height: 16.5pt
        }

        table.sheet0 tr.row246 {
            height: 16.5pt
        }

        table.sheet0 tr.row247 {
            height: 16.5pt
        }

        table.sheet0 tr.row248 {
            height: 16.5pt
        }

        table.sheet0 tr.row249 {
            height: 16.5pt
        }

        table.sheet0 tr.row250 {
            height: 16.5pt
        }

        table.sheet0 tr.row251 {
            height: 16.5pt
        }

        table.sheet0 tr.row252 {
            height: 16.5pt
        }

        table.sheet0 tr.row253 {
            height: 16.5pt
        }

        table.sheet0 tr.row254 {
            height: 16.5pt
        }

        table.sheet0 tr.row255 {
            height: 16.5pt
        }

        table.sheet0 tr.row256 {
            height: 16.5pt
        }

        table.sheet0 tr.row257 {
            height: 16.5pt
        }

        table.sheet0 tr.row258 {
            height: 16.5pt
        }

        table.sheet0 tr.row259 {
            height: 16.5pt
        }

        table.sheet0 tr.row260 {
            height: 16.5pt
        }

        table.sheet0 tr.row261 {
            height: 16.5pt
        }

        table.sheet0 tr.row262 {
            height: 16.5pt
        }

        table.sheet0 tr.row263 {
            height: 16.5pt
        }

        table.sheet0 tr.row264 {
            height: 16.5pt
        }

        table.sheet0 tr.row265 {
            height: 16.5pt
        }

        table.sheet0 tr.row266 {
            height: 16.5pt
        }

        table.sheet0 tr.row267 {
            height: 16.5pt
        }

        table.sheet0 tr.row268 {
            height: 16.5pt
        }

        table.sheet0 tr.row269 {
            height: 16.5pt
        }

        table.sheet0 tr.row270 {
            height: 16.5pt
        }

        table.sheet0 tr.row271 {
            height: 16.5pt
        }

        table.sheet0 tr.row272 {
            height: 16.5pt
        }

        table.sheet0 tr.row273 {
            height: 16.5pt
        }

        table.sheet0 tr.row274 {
            height: 16.5pt
        }

        table.sheet0 tr.row275 {
            height: 16.5pt
        }

        table.sheet0 tr.row276 {
            height: 16.5pt
        }

        table.sheet0 tr.row277 {
            height: 16.5pt
        }

        table.sheet0 tr.row278 {
            height: 16.5pt
        }

        table.sheet0 tr.row279 {
            height: 16.5pt
        }

        table.sheet0 tr.row280 {
            height: 16.5pt
        }

        table.sheet0 tr.row281 {
            height: 16.5pt
        }

        table.sheet0 tr.row282 {
            height: 16.5pt
        }

        table.sheet0 tr.row283 {
            height: 16.5pt
        }

        table.sheet0 tr.row284 {
            height: 16.5pt
        }

        table.sheet0 tr.row285 {
            height: 16.5pt
        }

        table.sheet0 tr.row286 {
            height: 16.5pt
        }

        table.sheet0 tr.row287 {
            height: 16.5pt
        }

        table.sheet0 tr.row288 {
            height: 16.5pt
        }

        table.sheet0 tr.row289 {
            height: 16.5pt
        }

        table.sheet0 tr.row290 {
            height: 16.5pt
        }

        table.sheet0 tr.row291 {
            height: 16.5pt
        }

        table.sheet0 tr.row292 {
            height: 16.5pt
        }

        table.sheet0 tr.row293 {
            height: 16.5pt
        }

        table.sheet0 tr.row294 {
            height: 16.5pt
        }

        table.sheet0 tr.row295 {
            height: 16.5pt
        }

        table.sheet0 tr.row296 {
            height: 16.5pt
        }

        table.sheet0 tr.row297 {
            height: 16.5pt
        }

        table.sheet0 tr.row298 {
            height: 16.5pt
        }

        table.sheet0 tr.row299 {
            height: 16.5pt
        }

        table.sheet0 tr.row300 {
            height: 16.5pt
        }

        table.sheet0 tr.row301 {
            height: 16.5pt
        }

        table.sheet0 tr.row302 {
            height: 16.5pt
        }

        table.sheet0 tr.row303 {
            height: 16.5pt
        }

        table.sheet0 tr.row304 {
            height: 16.5pt
        }

        table.sheet0 tr.row305 {
            height: 16.5pt
        }

        table.sheet0 tr.row306 {
            height: 16.5pt
        }

        table.sheet0 tr.row307 {
            height: 16.5pt
        }

        table.sheet0 tr.row308 {
            height: 16.5pt
        }

        table.sheet0 tr.row309 {
            height: 16.5pt
        }

        table.sheet0 tr.row310 {
            height: 16.5pt
        }

        table.sheet0 tr.row311 {
            height: 16.5pt
        }

        table.sheet0 tr.row312 {
            height: 16.5pt
        }

        table.sheet0 tr.row313 {
            height: 16.5pt
        }

        table.sheet0 tr.row314 {
            height: 16.5pt
        }

        table.sheet0 tr.row315 {
            height: 16.5pt
        }

        table.sheet0 tr.row316 {
            height: 16.5pt
        }

        table.sheet0 tr.row317 {
            height: 16.5pt
        }

        table.sheet0 tr.row318 {
            height: 16.5pt
        }

        table.sheet0 tr.row319 {
            height: 16.5pt
        }

        table.sheet0 tr.row320 {
            height: 16.5pt
        }

        table.sheet0 tr.row321 {
            height: 16.5pt
        }

        table.sheet0 tr.row322 {
            height: 16.5pt
        }

        table.sheet0 tr.row323 {
            height: 16.5pt
        }

        table.sheet0 tr.row324 {
            height: 16.5pt
        }

        table.sheet0 tr.row325 {
            height: 16.5pt
        }

        table.sheet0 tr.row326 {
            height: 16.5pt
        }

        table.sheet0 tr.row327 {
            height: 16.5pt
        }

        table.sheet0 tr.row328 {
            height: 16.5pt
        }

        table.sheet0 tr.row329 {
            height: 16.5pt
        }

        table.sheet0 tr.row330 {
            height: 16.5pt
        }

        table.sheet0 tr.row331 {
            height: 16.5pt
        }

        table.sheet0 tr.row332 {
            height: 16.5pt
        }

        table.sheet0 tr.row333 {
            height: 16.5pt
        }

        table.sheet0 tr.row334 {
            height: 16.5pt
        }

        table.sheet0 tr.row335 {
            height: 16.5pt
        }

        table.sheet0 tr.row336 {
            height: 16.5pt
        }

        table.sheet0 tr.row337 {
            height: 16.5pt
        }

        table.sheet0 tr.row338 {
            height: 16.5pt
        }

        table.sheet0 tr.row339 {
            height: 16.5pt
        }

        table.sheet0 tr.row340 {
            height: 16.5pt
        }

        table.sheet0 tr.row341 {
            height: 16.5pt
        }

        table.sheet0 tr.row342 {
            height: 16.5pt
        }

        table.sheet0 tr.row343 {
            height: 16.5pt
        }

        table.sheet0 tr.row344 {
            height: 16.5pt
        }

        table.sheet0 tr.row345 {
            height: 16.5pt
        }

        table.sheet0 tr.row346 {
            height: 16.5pt
        }

        table.sheet0 tr.row347 {
            height: 16.5pt
        }

        table.sheet0 tr.row348 {
            height: 16.5pt
        }

        table.sheet0 tr.row349 {
            height: 16.5pt
        }

        table.sheet0 tr.row350 {
            height: 16.5pt
        }

        table.sheet0 tr.row351 {
            height: 16.5pt
        }

        table.sheet0 tr.row352 {
            height: 16.5pt
        }

        table.sheet0 tr.row353 {
            height: 16.5pt
        }

        table.sheet0 tr.row354 {
            height: 16.5pt
        }

        table.sheet0 tr.row355 {
            height: 16.5pt
        }

        table.sheet0 tr.row356 {
            height: 16.5pt
        }

        table.sheet0 tr.row357 {
            height: 16.5pt
        }

        table.sheet0 tr.row358 {
            height: 16.5pt
        }

        table.sheet0 tr.row359 {
            height: 16.5pt
        }

        table.sheet0 tr.row360 {
            height: 16.5pt
        }

        table.sheet0 tr.row361 {
            height: 16.5pt
        }

        table.sheet0 tr.row362 {
            height: 16.5pt
        }

        table.sheet0 tr.row363 {
            height: 16.5pt
        }

        table.sheet0 tr.row364 {
            height: 16.5pt
        }

        table.sheet0 tr.row365 {
            height: 16.5pt
        }

        table.sheet0 tr.row366 {
            height: 16.5pt
        }

        table.sheet0 tr.row367 {
            height: 16.5pt
        }

        table.sheet0 tr.row368 {
            height: 16.5pt
        }

        table.sheet0 tr.row369 {
            height: 16.5pt
        }

        table.sheet0 tr.row370 {
            height: 16.5pt
        }

        table.sheet0 tr.row371 {
            height: 16.5pt
        }

        table.sheet0 tr.row372 {
            height: 16.5pt
        }

        table.sheet0 tr.row373 {
            height: 16.5pt
        }

        table.sheet0 tr.row374 {
            height: 16.5pt
        }

        table.sheet0 tr.row375 {
            height: 16.5pt
        }

        table.sheet0 tr.row376 {
            height: 16.5pt
        }

        table.sheet0 tr.row377 {
            height: 16.5pt
        }

        table.sheet0 tr.row378 {
            height: 16.5pt
        }

        table.sheet0 tr.row379 {
            height: 16.5pt
        }

        table.sheet0 tr.row380 {
            height: 16.5pt
        }

        table.sheet0 tr.row381 {
            height: 16.5pt
        }

        table.sheet0 tr.row382 {
            height: 16.5pt
        }

        table.sheet0 tr.row383 {
            height: 16.5pt
        }

        table.sheet0 tr.row384 {
            height: 16.5pt
        }

        table.sheet0 tr.row385 {
            height: 16.5pt
        }

        table.sheet0 tr.row386 {
            height: 16.5pt
        }

        table.sheet0 tr.row387 {
            height: 16.5pt
        }

        table.sheet0 tr.row388 {
            height: 16.5pt
        }

        table.sheet0 tr.row389 {
            height: 16.5pt
        }

        table.sheet0 tr.row390 {
            height: 16.5pt
        }

        table.sheet0 tr.row391 {
            height: 16.5pt
        }

        table.sheet0 tr.row392 {
            height: 16.5pt
        }

        table.sheet0 tr.row393 {
            height: 16.5pt
        }

        table.sheet0 tr.row394 {
            height: 16.5pt
        }

        table.sheet0 tr.row395 {
            height: 16.5pt
        }

        table.sheet0 tr.row396 {
            height: 16.5pt
        }

        table.sheet0 tr.row397 {
            height: 16.5pt
        }

        table.sheet0 tr.row398 {
            height: 16.5pt
        }

        table.sheet0 tr.row399 {
            height: 16.5pt
        }

        table.sheet0 tr.row400 {
            height: 16.5pt
        }

        table.sheet0 tr.row401 {
            height: 16.5pt
        }

        table.sheet0 tr.row402 {
            height: 16.5pt
        }

        table.sheet0 tr.row403 {
            height: 16.5pt
        }

        table.sheet0 tr.row404 {
            height: 16.5pt
        }

        table.sheet0 tr.row405 {
            height: 16.5pt
        }

        table.sheet0 tr.row406 {
            height: 16.5pt
        }

        table.sheet0 tr.row407 {
            height: 16.5pt
        }

        table.sheet0 tr.row408 {
            height: 16.5pt
        }

        table.sheet0 tr.row409 {
            height: 16.5pt
        }

        table.sheet0 tr.row410 {
            height: 16.5pt
        }

        table.sheet0 tr.row411 {
            height: 16.5pt
        }

        table.sheet0 tr.row412 {
            height: 16.5pt
        }

        table.sheet0 tr.row413 {
            height: 16.5pt
        }

        table.sheet0 tr.row414 {
            height: 16.5pt
        }

        table.sheet0 tr.row415 {
            height: 16.5pt
        }

        table.sheet0 tr.row416 {
            height: 16.5pt
        }

        table.sheet0 tr.row417 {
            height: 16.5pt
        }

        table.sheet0 tr.row418 {
            height: 16.5pt
        }

        table.sheet0 tr.row419 {
            height: 16.5pt
        }

        table.sheet0 tr.row420 {
            height: 16.5pt
        }

        table.sheet0 tr.row421 {
            height: 16.5pt
        }

        table.sheet0 tr.row422 {
            height: 16.5pt
        }

        table.sheet0 tr.row423 {
            height: 16.5pt
        }

        table.sheet0 tr.row424 {
            height: 16.5pt
        }

        table.sheet0 tr.row425 {
            height: 16.5pt
        }

        table.sheet0 tr.row426 {
            height: 16.5pt
        }

        table.sheet0 tr.row427 {
            height: 16.5pt
        }

        table.sheet0 tr.row428 {
            height: 16.5pt
        }

        table.sheet0 tr.row429 {
            height: 16.5pt
        }

        table.sheet0 tr.row430 {
            height: 16.5pt
        }

        table.sheet0 tr.row431 {
            height: 16.5pt
        }

        table.sheet0 tr.row432 {
            height: 16.5pt
        }

        table.sheet0 tr.row433 {
            height: 16.5pt
        }

        table.sheet0 tr.row434 {
            height: 16.5pt
        }

        table.sheet0 tr.row435 {
            height: 16.5pt
        }

        table.sheet0 tr.row436 {
            height: 16.5pt
        }

        table.sheet0 tr.row437 {
            height: 16.5pt
        }

        table.sheet0 tr.row438 {
            height: 16.5pt
        }

        table.sheet0 tr.row439 {
            height: 16.5pt
        }

        table.sheet0 tr.row440 {
            height: 16.5pt
        }

        table.sheet0 tr.row441 {
            height: 16.5pt
        }

        table.sheet0 tr.row442 {
            height: 16.5pt
        }

        table.sheet0 tr.row443 {
            height: 16.5pt
        }

        table.sheet0 tr.row444 {
            height: 16.5pt
        }

        table.sheet0 tr.row445 {
            height: 16.5pt
        }

        table.sheet0 tr.row446 {
            height: 16.5pt
        }

        table.sheet0 tr.row447 {
            height: 16.5pt
        }

        table.sheet0 tr.row448 {
            height: 16.5pt
        }

        table.sheet0 tr.row449 {
            height: 16.5pt
        }

        table.sheet0 tr.row450 {
            height: 16.5pt
        }

        table.sheet0 tr.row451 {
            height: 16.5pt
        }

        table.sheet0 tr.row452 {
            height: 16.5pt
        }

        table.sheet0 tr.row453 {
            height: 16.5pt
        }

        table.sheet0 tr.row454 {
            height: 16.5pt
        }

        table.sheet0 tr.row455 {
            height: 16.5pt
        }

        table.sheet0 tr.row456 {
            height: 16.5pt
        }

        table.sheet0 tr.row457 {
            height: 16.5pt
        }

        table.sheet0 tr.row458 {
            height: 16.5pt
        }

        table.sheet0 tr.row459 {
            height: 16.5pt
        }

        table.sheet0 tr.row460 {
            height: 16.5pt
        }

        table.sheet0 tr.row461 {
            height: 16.5pt
        }

        table.sheet0 tr.row462 {
            height: 16.5pt
        }

        table.sheet0 tr.row463 {
            height: 16.5pt
        }

        table.sheet0 tr.row464 {
            height: 16.5pt
        }

        table.sheet0 tr.row465 {
            height: 16.5pt
        }

        table.sheet0 tr.row466 {
            height: 16.5pt
        }

        table.sheet0 tr.row467 {
            height: 16.5pt
        }

        table.sheet0 tr.row468 {
            height: 16.5pt
        }

        table.sheet0 tr.row469 {
            height: 16.5pt
        }

        table.sheet0 tr.row470 {
            height: 16.5pt
        }

        table.sheet0 tr.row471 {
            height: 16.5pt
        }

        table.sheet0 tr.row472 {
            height: 16.5pt
        }

        table.sheet0 tr.row473 {
            height: 16.5pt
        }

        table.sheet0 tr.row474 {
            height: 16.5pt
        }

        table.sheet0 tr.row475 {
            height: 16.5pt
        }

        table.sheet0 tr.row476 {
            height: 16.5pt
        }

        table.sheet0 tr.row477 {
            height: 16.5pt
        }

        table.sheet0 tr.row478 {
            height: 16.5pt
        }

        table.sheet0 tr.row479 {
            height: 16.5pt
        }

        table.sheet0 tr.row480 {
            height: 16.5pt
        }

        table.sheet0 tr.row481 {
            height: 16.5pt
        }

        table.sheet0 tr.row482 {
            height: 16.5pt
        }

        table.sheet0 tr.row483 {
            height: 16.5pt
        }

        table.sheet0 tr.row484 {
            height: 16.5pt
        }

        table.sheet0 tr.row485 {
            height: 16.5pt
        }

        table.sheet0 tr.row486 {
            height: 16.5pt
        }

        table.sheet0 tr.row487 {
            height: 16.5pt
        }

        table.sheet0 tr.row488 {
            height: 16.5pt
        }

        table.sheet0 tr.row489 {
            height: 16.5pt
        }

        table.sheet0 tr.row490 {
            height: 16.5pt
        }

        table.sheet0 tr.row491 {
            height: 16.5pt
        }

        table.sheet0 tr.row492 {
            height: 16.5pt
        }

        table.sheet0 tr.row493 {
            height: 16.5pt
        }

        table.sheet0 tr.row494 {
            height: 16.5pt
        }

        table.sheet0 tr.row495 {
            height: 16.5pt
        }

        table.sheet0 tr.row496 {
            height: 16.5pt
        }

        table.sheet0 tr.row497 {
            height: 16.5pt
        }

        table.sheet0 tr.row498 {
            height: 16.5pt
        }

        table.sheet0 tr.row499 {
            height: 16.5pt
        }

        table.sheet0 tr.row500 {
            height: 16.5pt
        }

        table.sheet0 tr.row501 {
            height: 16.5pt
        }

        table.sheet0 tr.row502 {
            height: 16.5pt
        }

        table.sheet0 tr.row503 {
            height: 16.5pt
        }

        table.sheet0 tr.row504 {
            height: 16.5pt
        }

        table.sheet0 tr.row505 {
            height: 16.5pt
        }

        table.sheet0 tr.row506 {
            height: 16.5pt
        }

        table.sheet0 tr.row507 {
            height: 16.5pt
        }

        table.sheet0 tr.row508 {
            height: 16.5pt
        }

        table.sheet0 tr.row509 {
            height: 16.5pt
        }

        table.sheet0 tr.row510 {
            height: 16.5pt
        }

        table.sheet0 tr.row511 {
            height: 16.5pt
        }

        table.sheet0 tr.row512 {
            height: 16.5pt
        }

        table.sheet0 tr.row513 {
            height: 16.5pt
        }

        table.sheet0 tr.row514 {
            height: 16.5pt
        }

        table.sheet0 tr.row515 {
            height: 16.5pt
        }

        table.sheet0 tr.row516 {
            height: 16.5pt
        }

        table.sheet0 tr.row517 {
            height: 16.5pt
        }

        table.sheet0 tr.row518 {
            height: 16.5pt
        }

        table.sheet0 tr.row519 {
            height: 16.5pt
        }

        table.sheet0 tr.row520 {
            height: 16.5pt
        }

        table.sheet0 tr.row521 {
            height: 16.5pt
        }

        table.sheet0 tr.row522 {
            height: 16.5pt
        }

        table.sheet0 tr.row523 {
            height: 16.5pt
        }

        table.sheet0 tr.row524 {
            height: 16.5pt
        }

        table.sheet0 tr.row525 {
            height: 16.5pt
        }

        table.sheet0 tr.row526 {
            height: 16.5pt
        }

        table.sheet0 tr.row527 {
            height: 16.5pt
        }

        table.sheet0 tr.row528 {
            height: 16.5pt
        }

        table.sheet0 tr.row529 {
            height: 16.5pt
        }

        table.sheet0 tr.row530 {
            height: 16.5pt
        }

        table.sheet0 tr.row531 {
            height: 16.5pt
        }

        table.sheet0 tr.row532 {
            height: 16.5pt
        }

        table.sheet0 tr.row533 {
            height: 16.5pt
        }

        table.sheet0 tr.row534 {
            height: 16.5pt
        }

        table.sheet0 tr.row535 {
            height: 16.5pt
        }

        table.sheet0 tr.row536 {
            height: 16.5pt
        }

        table.sheet0 tr.row537 {
            height: 16.5pt
        }

        table.sheet0 tr.row538 {
            height: 16.5pt
        }

        table.sheet0 tr.row539 {
            height: 16.5pt
        }

        table.sheet0 tr.row540 {
            height: 16.5pt
        }

        table.sheet0 tr.row541 {
            height: 16.5pt
        }

        table.sheet0 tr.row542 {
            height: 16.5pt
        }

        table.sheet0 tr.row543 {
            height: 16.5pt
        }

        table.sheet0 tr.row544 {
            height: 16.5pt
        }

        table.sheet0 tr.row545 {
            height: 16.5pt
        }

        table.sheet0 tr.row546 {
            height: 16.5pt
        }

        table.sheet0 tr.row547 {
            height: 16.5pt
        }

        table.sheet0 tr.row548 {
            height: 16.5pt
        }

        table.sheet0 tr.row549 {
            height: 16.5pt
        }

        table.sheet0 tr.row550 {
            height: 16.5pt
        }

        table.sheet0 tr.row551 {
            height: 16.5pt
        }

        table.sheet0 tr.row552 {
            height: 16.5pt
        }

        table.sheet0 tr.row553 {
            height: 16.5pt
        }

        table.sheet0 tr.row554 {
            height: 16.5pt
        }

        table.sheet0 tr.row555 {
            height: 16.5pt
        }

        table.sheet0 tr.row556 {
            height: 16.5pt
        }

        table.sheet0 tr.row557 {
            height: 16.5pt
        }

        table.sheet0 tr.row558 {
            height: 16.5pt
        }

        table.sheet0 tr.row559 {
            height: 16.5pt
        }

        table.sheet0 tr.row560 {
            height: 16.5pt
        }

        table.sheet0 tr.row561 {
            height: 16.5pt
        }

        table.sheet0 tr.row562 {
            height: 16.5pt
        }

        table.sheet0 tr.row563 {
            height: 16.5pt
        }

        table.sheet0 tr.row564 {
            height: 16.5pt
        }

        table.sheet0 tr.row565 {
            height: 16.5pt
        }

        table.sheet0 tr.row566 {
            height: 16.5pt
        }

        table.sheet0 tr.row567 {
            height: 16.5pt
        }

        table.sheet0 tr.row568 {
            height: 16.5pt
        }

        table.sheet0 tr.row569 {
            height: 16.5pt
        }

        table.sheet0 tr.row570 {
            height: 16.5pt
        }

        table.sheet0 tr.row571 {
            height: 16.5pt
        }

        table.sheet0 tr.row572 {
            height: 16.5pt
        }

        table.sheet0 tr.row573 {
            height: 16.5pt
        }

        table.sheet0 tr.row574 {
            height: 16.5pt
        }

        table.sheet0 tr.row575 {
            height: 16.5pt
        }

        table.sheet0 tr.row576 {
            height: 16.5pt
        }

        table.sheet0 tr.row577 {
            height: 16.5pt
        }

        table.sheet0 tr.row578 {
            height: 16.5pt
        }

        table.sheet0 tr.row579 {
            height: 16.5pt
        }

        table.sheet0 tr.row580 {
            height: 16.5pt
        }

        table.sheet0 tr.row581 {
            height: 16.5pt
        }

        table.sheet0 tr.row582 {
            height: 16.5pt
        }

        table.sheet0 tr.row583 {
            height: 16.5pt
        }

        table.sheet0 tr.row584 {
            height: 16.5pt
        }

        table.sheet0 tr.row585 {
            height: 16.5pt
        }

        table.sheet0 tr.row586 {
            height: 16.5pt
        }

        table.sheet0 tr.row587 {
            height: 16.5pt
        }

        table.sheet0 tr.row588 {
            height: 16.5pt
        }

        table.sheet0 tr.row589 {
            height: 16.5pt
        }

        table.sheet0 tr.row590 {
            height: 16.5pt
        }

        table.sheet0 tr.row591 {
            height: 16.5pt
        }

        table.sheet0 tr.row592 {
            height: 16.5pt
        }

        table.sheet0 tr.row593 {
            height: 16.5pt
        }

        table.sheet0 tr.row594 {
            height: 16.5pt
        }

        table.sheet0 tr.row595 {
            height: 16.5pt
        }

        table.sheet0 tr.row596 {
            height: 16.5pt
        }

        table.sheet0 tr.row597 {
            height: 16.5pt
        }

        table.sheet0 tr.row598 {
            height: 16.5pt
        }

        table.sheet0 tr.row599 {
            height: 16.5pt
        }

        table.sheet0 tr.row600 {
            height: 16.5pt
        }

        table.sheet0 tr.row601 {
            height: 16.5pt
        }

        table.sheet0 tr.row602 {
            height: 16.5pt
        }

        table.sheet0 tr.row603 {
            height: 16.5pt
        }

        table.sheet0 tr.row604 {
            height: 16.5pt
        }

        table.sheet0 tr.row605 {
            height: 16.5pt
        }

        table.sheet0 tr.row606 {
            height: 16.5pt
        }

        table.sheet0 tr.row607 {
            height: 16.5pt
        }

        table.sheet0 tr.row608 {
            height: 16.5pt
        }

        table.sheet0 tr.row609 {
            height: 16.5pt
        }

        table.sheet0 tr.row610 {
            height: 16.5pt
        }

        table.sheet0 tr.row611 {
            height: 16.5pt
        }

        table.sheet0 tr.row612 {
            height: 16.5pt
        }

        table.sheet0 tr.row613 {
            height: 16.5pt
        }

        table.sheet0 tr.row614 {
            height: 16.5pt
        }

        table.sheet0 tr.row615 {
            height: 16.5pt
        }

        table.sheet0 tr.row616 {
            height: 16.5pt
        }

        table.sheet0 tr.row617 {
            height: 16.5pt
        }

        table.sheet0 tr.row618 {
            height: 16.5pt
        }

        table.sheet0 tr.row619 {
            height: 16.5pt
        }

        table.sheet0 tr.row620 {
            height: 16.5pt
        }

        table.sheet0 tr.row621 {
            height: 16.5pt
        }

        table.sheet0 tr.row622 {
            height: 16.5pt
        }

        table.sheet0 tr.row623 {
            height: 16.5pt
        }

        table.sheet0 tr.row624 {
            height: 16.5pt
        }

        table.sheet0 tr.row625 {
            height: 16.5pt
        }

        table.sheet0 tr.row626 {
            height: 16.5pt
        }

        table.sheet0 tr.row627 {
            height: 16.5pt
        }

        table.sheet0 tr.row628 {
            height: 16.5pt
        }

        table.sheet0 tr.row629 {
            height: 16.5pt
        }

        table.sheet0 tr.row630 {
            height: 16.5pt
        }

        table.sheet0 tr.row631 {
            height: 16.5pt
        }

        table.sheet0 tr.row632 {
            height: 16.5pt
        }

        table.sheet0 tr.row633 {
            height: 16.5pt
        }

        table.sheet0 tr.row634 {
            height: 16.5pt
        }

        table.sheet0 tr.row635 {
            height: 16.5pt
        }

        table.sheet0 tr.row636 {
            height: 16.5pt
        }

        table.sheet0 tr.row637 {
            height: 16.5pt
        }

        table.sheet0 tr.row638 {
            height: 16.5pt
        }

        table.sheet0 tr.row639 {
            height: 16.5pt
        }

        table.sheet0 tr.row640 {
            height: 16.5pt
        }

        table.sheet0 tr.row641 {
            height: 16.5pt
        }

        table.sheet0 tr.row642 {
            height: 16.5pt
        }

        table.sheet0 tr.row643 {
            height: 16.5pt
        }

        table.sheet0 tr.row644 {
            height: 16.5pt
        }

        table.sheet0 tr.row645 {
            height: 16.5pt
        }

        table.sheet0 tr.row646 {
            height: 16.5pt
        }

        table.sheet0 tr.row647 {
            height: 16.5pt
        }

        table.sheet0 tr.row648 {
            height: 16.5pt
        }

        table.sheet0 tr.row649 {
            height: 16.5pt
        }

        table.sheet0 tr.row650 {
            height: 16.5pt
        }

        table.sheet0 tr.row651 {
            height: 16.5pt
        }

        table.sheet0 tr.row652 {
            height: 16.5pt
        }

        table.sheet0 tr.row653 {
            height: 16.5pt
        }

        table.sheet0 tr.row654 {
            height: 16.5pt
        }

        table.sheet0 tr.row655 {
            height: 16.5pt
        }

        table.sheet0 tr.row656 {
            height: 16.5pt
        }

        table.sheet0 tr.row657 {
            height: 16.5pt
        }

        table.sheet0 tr.row658 {
            height: 16.5pt
        }

        table.sheet0 tr.row659 {
            height: 16.5pt
        }

        table.sheet0 tr.row660 {
            height: 16.5pt
        }

        table.sheet0 tr.row661 {
            height: 16.5pt
        }

        table.sheet0 tr.row662 {
            height: 16.5pt
        }

        table.sheet0 tr.row663 {
            height: 16.5pt
        }

        table.sheet0 tr.row664 {
            height: 16.5pt
        }

        table.sheet0 tr.row665 {
            height: 16.5pt
        }

        table.sheet0 tr.row666 {
            height: 16.5pt
        }

        table.sheet0 tr.row667 {
            height: 16.5pt
        }

        table.sheet0 tr.row668 {
            height: 16.5pt
        }

        table.sheet0 tr.row669 {
            height: 16.5pt
        }

        table.sheet0 tr.row670 {
            height: 16.5pt
        }

        table.sheet0 tr.row671 {
            height: 16.5pt
        }

        table.sheet0 tr.row672 {
            height: 16.5pt
        }

        table.sheet0 tr.row673 {
            height: 16.5pt
        }

        table.sheet0 tr.row674 {
            height: 16.5pt
        }

        table.sheet0 tr.row675 {
            height: 16.5pt
        }

        table.sheet0 tr.row676 {
            height: 16.5pt
        }

        table.sheet0 tr.row677 {
            height: 16.5pt
        }

        table.sheet0 tr.row678 {
            height: 16.5pt
        }

        table.sheet0 tr.row679 {
            height: 16.5pt
        }

        table.sheet0 tr.row680 {
            height: 16.5pt
        }

        table.sheet0 tr.row681 {
            height: 16.5pt
        }

        table.sheet0 tr.row682 {
            height: 16.5pt
        }

        table.sheet0 tr.row683 {
            height: 16.5pt
        }

        table.sheet0 tr.row684 {
            height: 16.5pt
        }

        table.sheet0 tr.row685 {
            height: 16.5pt
        }

        table.sheet0 tr.row686 {
            height: 16.5pt
        }

        table.sheet0 tr.row687 {
            height: 16.5pt
        }

        table.sheet0 tr.row688 {
            height: 16.5pt
        }

        table.sheet0 tr.row689 {
            height: 16.5pt
        }

        table.sheet0 tr.row690 {
            height: 16.5pt
        }

        table.sheet0 tr.row691 {
            height: 16.5pt
        }

        table.sheet0 tr.row692 {
            height: 16.5pt
        }

        table.sheet0 tr.row693 {
            height: 16.5pt
        }

        table.sheet0 tr.row694 {
            height: 16.5pt
        }

        table.sheet0 tr.row695 {
            height: 16.5pt
        }

        table.sheet0 tr.row696 {
            height: 16.5pt
        }

        table.sheet0 tr.row697 {
            height: 16.5pt
        }

        table.sheet0 tr.row698 {
            height: 16.5pt
        }

        table.sheet0 tr.row699 {
            height: 16.5pt
        }

        table.sheet0 tr.row700 {
            height: 16.5pt
        }

        table.sheet0 tr.row701 {
            height: 16.5pt
        }

        table.sheet0 tr.row702 {
            height: 16.5pt
        }

        table.sheet0 tr.row703 {
            height: 16.5pt
        }

        table.sheet0 tr.row704 {
            height: 16.5pt
        }

        table.sheet0 tr.row705 {
            height: 16.5pt
        }

        table.sheet0 tr.row706 {
            height: 16.5pt
        }

        table.sheet0 tr.row707 {
            height: 16.5pt
        }

        table.sheet0 tr.row708 {
            height: 16.5pt
        }

        table.sheet0 tr.row709 {
            height: 16.5pt
        }

        table.sheet0 tr.row710 {
            height: 16.5pt
        }

        table.sheet0 tr.row711 {
            height: 16.5pt
        }

        table.sheet0 tr.row712 {
            height: 16.5pt
        }

        table.sheet0 tr.row713 {
            height: 16.5pt
        }

        table.sheet0 tr.row714 {
            height: 16.5pt
        }

        table.sheet0 tr.row715 {
            height: 16.5pt
        }

        table.sheet0 tr.row716 {
            height: 16.5pt
        }

        table.sheet0 tr.row717 {
            height: 16.5pt
        }

        table.sheet0 tr.row718 {
            height: 16.5pt
        }

        table.sheet0 tr.row719 {
            height: 16.5pt
        }

        table.sheet0 tr.row720 {
            height: 16.5pt
        }

        table.sheet0 tr.row721 {
            height: 16.5pt
        }

        table.sheet0 tr.row722 {
            height: 16.5pt
        }

        table.sheet0 tr.row723 {
            height: 16.5pt
        }

        table.sheet0 tr.row724 {
            height: 16.5pt
        }

        table.sheet0 tr.row725 {
            height: 16.5pt
        }

        table.sheet0 tr.row726 {
            height: 16.5pt
        }

        table.sheet0 tr.row727 {
            height: 16.5pt
        }

        table.sheet0 tr.row728 {
            height: 16.5pt
        }

        table.sheet0 tr.row729 {
            height: 16.5pt
        }

        table.sheet0 tr.row730 {
            height: 16.5pt
        }

        table.sheet0 tr.row731 {
            height: 16.5pt
        }

        table.sheet0 tr.row732 {
            height: 16.5pt
        }

        table.sheet0 tr.row733 {
            height: 16.5pt
        }

        table.sheet0 tr.row734 {
            height: 16.5pt
        }

        table.sheet0 tr.row735 {
            height: 16.5pt
        }

        table.sheet0 tr.row736 {
            height: 16.5pt
        }

        table.sheet0 tr.row737 {
            height: 16.5pt
        }

        table.sheet0 tr.row738 {
            height: 16.5pt
        }

        table.sheet0 tr.row739 {
            height: 16.5pt
        }

        table.sheet0 tr.row740 {
            height: 16.5pt
        }

        table.sheet0 tr.row741 {
            height: 16.5pt
        }

        table.sheet0 tr.row742 {
            height: 16.5pt
        }

        table.sheet0 tr.row743 {
            height: 16.5pt
        }

        table.sheet0 tr.row744 {
            height: 16.5pt
        }

        table.sheet0 tr.row745 {
            height: 16.5pt
        }

        table.sheet0 tr.row746 {
            height: 16.5pt
        }

        table.sheet0 tr.row747 {
            height: 16.5pt
        }

        table.sheet0 tr.row748 {
            height: 16.5pt
        }

        table.sheet0 tr.row749 {
            height: 16.5pt
        }

        table.sheet0 tr.row750 {
            height: 16.5pt
        }

        table.sheet0 tr.row751 {
            height: 16.5pt
        }

        table.sheet0 tr.row752 {
            height: 16.5pt
        }

        table.sheet0 tr.row753 {
            height: 16.5pt
        }

        table.sheet0 tr.row754 {
            height: 16.5pt
        }

        table.sheet0 tr.row755 {
            height: 16.5pt
        }

        table.sheet0 tr.row756 {
            height: 16.5pt
        }

        table.sheet0 tr.row757 {
            height: 16.5pt
        }

        table.sheet0 tr.row758 {
            height: 16.5pt
        }

        table.sheet0 tr.row759 {
            height: 16.5pt
        }

        table.sheet0 tr.row760 {
            height: 16.5pt
        }

        table.sheet0 tr.row761 {
            height: 16.5pt
        }

        table.sheet0 tr.row762 {
            height: 16.5pt
        }

        table.sheet0 tr.row763 {
            height: 16.5pt
        }

        table.sheet0 tr.row764 {
            height: 16.5pt
        }

        table.sheet0 tr.row765 {
            height: 16.5pt
        }

        table.sheet0 tr.row766 {
            height: 16.5pt
        }

        table.sheet0 tr.row767 {
            height: 16.5pt
        }

        table.sheet0 tr.row768 {
            height: 16.5pt
        }

        table.sheet0 tr.row769 {
            height: 16.5pt
        }

        table.sheet0 tr.row770 {
            height: 16.5pt
        }

        table.sheet0 tr.row771 {
            height: 16.5pt
        }

        table.sheet0 tr.row772 {
            height: 16.5pt
        }

        table.sheet0 tr.row773 {
            height: 16.5pt
        }

        table.sheet0 tr.row774 {
            height: 16.5pt
        }

        table.sheet0 tr.row775 {
            height: 16.5pt
        }

        table.sheet0 tr.row776 {
            height: 16.5pt
        }

        table.sheet0 tr.row777 {
            height: 16.5pt
        }

        table.sheet0 tr.row778 {
            height: 16.5pt
        }

        table.sheet0 tr.row779 {
            height: 16.5pt
        }

        table.sheet0 tr.row780 {
            height: 16.5pt
        }

        table.sheet0 tr.row781 {
            height: 16.5pt
        }

        table.sheet0 tr.row782 {
            height: 16.5pt
        }

        table.sheet0 tr.row783 {
            height: 16.5pt
        }

        table.sheet0 tr.row784 {
            height: 16.5pt
        }

        table.sheet0 tr.row785 {
            height: 16.5pt
        }

        table.sheet0 tr.row786 {
            height: 16.5pt
        }

        table.sheet0 tr.row787 {
            height: 16.5pt
        }

        table.sheet0 tr.row788 {
            height: 16.5pt
        }

        table.sheet0 tr.row789 {
            height: 16.5pt
        }

        table.sheet0 tr.row790 {
            height: 16.5pt
        }

        table.sheet0 tr.row791 {
            height: 16.5pt
        }

        table.sheet0 tr.row792 {
            height: 16.5pt
        }

        table.sheet0 tr.row793 {
            height: 16.5pt
        }

        table.sheet0 tr.row794 {
            height: 16.5pt
        }

        table.sheet0 tr.row795 {
            height: 16.5pt
        }

        table.sheet0 tr.row796 {
            height: 16.5pt
        }

        table.sheet0 tr.row797 {
            height: 16.5pt
        }

        table.sheet0 tr.row798 {
            height: 16.5pt
        }

        table.sheet0 tr.row799 {
            height: 16.5pt
        }

        table.sheet0 tr.row800 {
            height: 16.5pt
        }

        table.sheet0 tr.row801 {
            height: 16.5pt
        }

        table.sheet0 tr.row802 {
            height: 16.5pt
        }

        table.sheet0 tr.row803 {
            height: 16.5pt
        }

        table.sheet0 tr.row804 {
            height: 16.5pt
        }

        table.sheet0 tr.row805 {
            height: 16.5pt
        }

        table.sheet0 tr.row806 {
            height: 16.5pt
        }

        table.sheet0 tr.row807 {
            height: 16.5pt
        }

        table.sheet0 tr.row808 {
            height: 16.5pt
        }

        table.sheet0 tr.row809 {
            height: 16.5pt
        }

        table.sheet0 tr.row810 {
            height: 16.5pt
        }

        table.sheet0 tr.row811 {
            height: 16.5pt
        }

        table.sheet0 tr.row812 {
            height: 16.5pt
        }

        table.sheet0 tr.row813 {
            height: 16.5pt
        }

        table.sheet0 tr.row814 {
            height: 16.5pt
        }

        table.sheet0 tr.row815 {
            height: 16.5pt
        }

        table.sheet0 tr.row816 {
            height: 16.5pt
        }

        table.sheet0 tr.row817 {
            height: 16.5pt
        }

        table.sheet0 tr.row818 {
            height: 16.5pt
        }

        table.sheet0 tr.row819 {
            height: 16.5pt
        }

        table.sheet0 tr.row820 {
            height: 16.5pt
        }

        table.sheet0 tr.row821 {
            height: 16.5pt
        }

        table.sheet0 tr.row822 {
            height: 16.5pt
        }

        table.sheet0 tr.row823 {
            height: 16.5pt
        }

        table.sheet0 tr.row824 {
            height: 16.5pt
        }

        table.sheet0 tr.row825 {
            height: 16.5pt
        }

        table.sheet0 tr.row826 {
            height: 16.5pt
        }

        table.sheet0 tr.row827 {
            height: 16.5pt
        }

        table.sheet0 tr.row828 {
            height: 16.5pt
        }

        table.sheet0 tr.row829 {
            height: 16.5pt
        }

        table.sheet0 tr.row830 {
            height: 16.5pt
        }

        table.sheet0 tr.row831 {
            height: 16.5pt
        }

        table.sheet0 tr.row832 {
            height: 16.5pt
        }

        table.sheet0 tr.row833 {
            height: 16.5pt
        }

        table.sheet0 tr.row834 {
            height: 16.5pt
        }

        table.sheet0 tr.row835 {
            height: 16.5pt
        }

        table.sheet0 tr.row836 {
            height: 16.5pt
        }

        table.sheet0 tr.row837 {
            height: 16.5pt
        }

        table.sheet0 tr.row838 {
            height: 16.5pt
        }

        table.sheet0 tr.row839 {
            height: 16.5pt
        }

        table.sheet0 tr.row840 {
            height: 16.5pt
        }

        table.sheet0 tr.row841 {
            height: 16.5pt
        }

        table.sheet0 tr.row842 {
            height: 16.5pt
        }

        table.sheet0 tr.row843 {
            height: 16.5pt
        }

        table.sheet0 tr.row844 {
            height: 16.5pt
        }

        table.sheet0 tr.row845 {
            height: 16.5pt
        }

        table.sheet0 tr.row846 {
            height: 16.5pt
        }

        table.sheet0 tr.row847 {
            height: 16.5pt
        }

        table.sheet0 tr.row848 {
            height: 16.5pt
        }

        table.sheet0 tr.row849 {
            height: 16.5pt
        }

        table.sheet0 tr.row850 {
            height: 16.5pt
        }

        table.sheet0 tr.row851 {
            height: 16.5pt
        }

        table.sheet0 tr.row852 {
            height: 16.5pt
        }

        table.sheet0 tr.row853 {
            height: 16.5pt
        }

        table.sheet0 tr.row854 {
            height: 16.5pt
        }

        table.sheet0 tr.row855 {
            height: 16.5pt
        }

        table.sheet0 tr.row856 {
            height: 16.5pt
        }

        table.sheet0 tr.row857 {
            height: 16.5pt
        }

        table.sheet0 tr.row858 {
            height: 16.5pt
        }

        table.sheet0 tr.row859 {
            height: 16.5pt
        }

        table.sheet0 tr.row860 {
            height: 16.5pt
        }

        table.sheet0 tr.row861 {
            height: 16.5pt
        }

        table.sheet0 tr.row862 {
            height: 16.5pt
        }

        table.sheet0 tr.row863 {
            height: 16.5pt
        }

        table.sheet0 tr.row864 {
            height: 16.5pt
        }

        table.sheet0 tr.row865 {
            height: 16.5pt
        }

        table.sheet0 tr.row866 {
            height: 16.5pt
        }

        table.sheet0 tr.row867 {
            height: 16.5pt
        }

        table.sheet0 tr.row868 {
            height: 16.5pt
        }

        table.sheet0 tr.row869 {
            height: 16.5pt
        }

        table.sheet0 tr.row870 {
            height: 16.5pt
        }

        table.sheet0 tr.row871 {
            height: 16.5pt
        }

        table.sheet0 tr.row872 {
            height: 16.5pt
        }

        table.sheet0 tr.row873 {
            height: 16.5pt
        }

        table.sheet0 tr.row874 {
            height: 16.5pt
        }

        table.sheet0 tr.row875 {
            height: 16.5pt
        }

        table.sheet0 tr.row876 {
            height: 16.5pt
        }

        table.sheet0 tr.row877 {
            height: 16.5pt
        }

        table.sheet0 tr.row878 {
            height: 16.5pt
        }

        table.sheet0 tr.row879 {
            height: 16.5pt
        }

        table.sheet0 tr.row880 {
            height: 16.5pt
        }

        table.sheet0 tr.row881 {
            height: 16.5pt
        }

        table.sheet0 tr.row882 {
            height: 16.5pt
        }

        table.sheet0 tr.row883 {
            height: 16.5pt
        }

        table.sheet0 tr.row884 {
            height: 16.5pt
        }

        table.sheet0 tr.row885 {
            height: 16.5pt
        }

        table.sheet0 tr.row886 {
            height: 16.5pt
        }

        table.sheet0 tr.row887 {
            height: 16.5pt
        }

        table.sheet0 tr.row888 {
            height: 16.5pt
        }

        table.sheet0 tr.row889 {
            height: 16.5pt
        }

        table.sheet0 tr.row890 {
            height: 16.5pt
        }

        table.sheet0 tr.row891 {
            height: 16.5pt
        }

        table.sheet0 tr.row892 {
            height: 16.5pt
        }

        table.sheet0 tr.row893 {
            height: 16.5pt
        }

        table.sheet0 tr.row894 {
            height: 16.5pt
        }

        table.sheet0 tr.row895 {
            height: 16.5pt
        }

        table.sheet0 tr.row896 {
            height: 16.5pt
        }

        table.sheet0 tr.row897 {
            height: 16.5pt
        }

        table.sheet0 tr.row898 {
            height: 16.5pt
        }

        table.sheet0 tr.row899 {
            height: 16.5pt
        }

        table.sheet0 tr.row900 {
            height: 16.5pt
        }

        table.sheet0 tr.row901 {
            height: 16.5pt
        }

        table.sheet0 tr.row902 {
            height: 16.5pt
        }

        table.sheet0 tr.row903 {
            height: 16.5pt
        }

        table.sheet0 tr.row904 {
            height: 16.5pt
        }

        table.sheet0 tr.row905 {
            height: 16.5pt
        }

        table.sheet0 tr.row906 {
            height: 16.5pt
        }

        table.sheet0 tr.row907 {
            height: 16.5pt
        }

        table.sheet0 tr.row908 {
            height: 16.5pt
        }

        table.sheet0 tr.row909 {
            height: 16.5pt
        }

        table.sheet0 tr.row910 {
            height: 16.5pt
        }

        table.sheet0 tr.row911 {
            height: 16.5pt
        }

        table.sheet0 tr.row912 {
            height: 16.5pt
        }

        table.sheet0 tr.row913 {
            height: 16.5pt
        }

        table.sheet0 tr.row914 {
            height: 16.5pt
        }

        table.sheet0 tr.row915 {
            height: 16.5pt
        }

        table.sheet0 tr.row916 {
            height: 16.5pt
        }

        table.sheet0 tr.row917 {
            height: 16.5pt
        }

        table.sheet0 tr.row918 {
            height: 16.5pt
        }

        table.sheet0 tr.row919 {
            height: 16.5pt
        }

        table.sheet0 tr.row920 {
            height: 16.5pt
        }

        table.sheet0 tr.row921 {
            height: 16.5pt
        }

        table.sheet0 tr.row922 {
            height: 16.5pt
        }

        table.sheet0 tr.row923 {
            height: 16.5pt
        }

        table.sheet0 tr.row924 {
            height: 16.5pt
        }

        table.sheet0 tr.row925 {
            height: 16.5pt
        }

        table.sheet0 tr.row926 {
            height: 16.5pt
        }

        table.sheet0 tr.row927 {
            height: 16.5pt
        }

        table.sheet0 tr.row928 {
            height: 16.5pt
        }

        table.sheet0 tr.row929 {
            height: 16.5pt
        }

        table.sheet0 tr.row930 {
            height: 16.5pt
        }

        table.sheet0 tr.row931 {
            height: 16.5pt
        }

        table.sheet0 tr.row932 {
            height: 16.5pt
        }

        table.sheet0 tr.row933 {
            height: 16.5pt
        }

        table.sheet0 tr.row934 {
            height: 16.5pt
        }

        table.sheet0 tr.row935 {
            height: 16.5pt
        }

        table.sheet0 tr.row936 {
            height: 16.5pt
        }

        table.sheet0 tr.row937 {
            height: 16.5pt
        }

        table.sheet0 tr.row938 {
            height: 16.5pt
        }

        table.sheet0 tr.row939 {
            height: 16.5pt
        }

        table.sheet0 tr.row940 {
            height: 16.5pt
        }

        table.sheet0 tr.row941 {
            height: 16.5pt
        }

        table.sheet0 tr.row942 {
            height: 16.5pt
        }

        table.sheet0 tr.row943 {
            height: 16.5pt
        }

        table.sheet0 tr.row944 {
            height: 16.5pt
        }

        table.sheet0 tr.row945 {
            height: 16.5pt
        }

        table.sheet0 tr.row946 {
            height: 16.5pt
        }

        table.sheet0 tr.row947 {
            height: 16.5pt
        }

        table.sheet0 tr.row948 {
            height: 16.5pt
        }

        table.sheet0 tr.row949 {
            height: 16.5pt
        }

        table.sheet0 tr.row950 {
            height: 16.5pt
        }

        table.sheet0 tr.row951 {
            height: 16.5pt
        }

        table.sheet0 tr.row952 {
            height: 16.5pt
        }

        table.sheet0 tr.row953 {
            height: 16.5pt
        }

        table.sheet0 tr.row954 {
            height: 16.5pt
        }

        table.sheet0 tr.row955 {
            height: 16.5pt
        }

        table.sheet0 tr.row956 {
            height: 16.5pt
        }

        table.sheet0 tr.row957 {
            height: 16.5pt
        }

        table.sheet0 tr.row958 {
            height: 16.5pt
        }

        table.sheet0 tr.row959 {
            height: 16.5pt
        }

        table.sheet0 tr.row960 {
            height: 16.5pt
        }

        table.sheet0 tr.row961 {
            height: 16.5pt
        }

        table.sheet0 tr.row962 {
            height: 16.5pt
        }

        table.sheet0 tr.row963 {
            height: 16.5pt
        }

        table.sheet0 tr.row964 {
            height: 16.5pt
        }

        table.sheet0 tr.row965 {
            height: 16.5pt
        }

        table.sheet0 tr.row966 {
            height: 16.5pt
        }

        table.sheet0 tr.row967 {
            height: 16.5pt
        }

        table.sheet0 tr.row968 {
            height: 16.5pt
        }

        table.sheet0 tr.row969 {
            height: 16.5pt
        }

        table.sheet0 tr.row970 {
            height: 16.5pt
        }

        table.sheet0 tr.row971 {
            height: 16.5pt
        }

        table.sheet0 tr.row972 {
            height: 16.5pt
        }

        table.sheet0 tr.row973 {
            height: 16.5pt
        }

        table.sheet0 tr.row974 {
            height: 16.5pt
        }

        table.sheet0 tr.row975 {
            height: 16.5pt
        }

        table.sheet0 tr.row976 {
            height: 16.5pt
        }

        table.sheet0 tr.row977 {
            height: 16.5pt
        }

        table.sheet0 tr.row978 {
            height: 16.5pt
        }

        table.sheet0 tr.row979 {
            height: 16.5pt
        }

        table.sheet0 tr.row980 {
            height: 16.5pt
        }

        table.sheet0 tr.row981 {
            height: 16.5pt
        }

        table.sheet0 tr.row982 {
            height: 16.5pt
        }

        table.sheet0 tr.row983 {
            height: 16.5pt
        }

        table.sheet0 tr.row984 {
            height: 16.5pt
        }

        table.sheet0 tr.row985 {
            height: 16.5pt
        }

        table.sheet0 tr.row986 {
            height: 16.5pt
        }

        table.sheet0 tr.row987 {
            height: 16.5pt
        }

        table.sheet0 tr.row988 {
            height: 16.5pt
        }

        table.sheet0 tr.row989 {
            height: 16.5pt
        }

        table.sheet0 tr.row990 {
            height: 16.5pt
        }

        table.sheet0 tr.row991 {
            height: 16.5pt
        }

        table.sheet0 tr.row992 {
            height: 16.5pt
        }

        table.sheet0 tr.row993 {
            height: 16.5pt
        }

        table.sheet0 tr.row994 {
            height: 16.5pt
        }

        table.sheet0 tr.row995 {
            height: 16.5pt
        }

        table.sheet0 tr.row996 {
            height: 16.5pt
        }

        table.sheet0 tr.row997 {
            height: 16.5pt
        }

        table.sheet0 tr.row998 {
            height: 16.5pt
        }

        table.sheet0 tr.row999 {
            height: 16.5pt
        }
    </style>
    <style>
        @page {
            margin-left: 0.25in;
            margin-right: 0.25in;
            margin-top: 0.75in;
            margin-bottom: 0.75in;
        }

        body {
            margin-left: 0.25in;
            margin-right: 0.25in;
            margin-top: 0.75in;
            margin-bottom: 0.75in;
        }
    </style>
</head>

<body>

    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <col class="col10">
        <col class="col11">
        <col class="col12">
        <col class="col13">
        <col class="col14">
        <col class="col15">
        <col class="col16">
        <col class="col17">
        <col class="col18">
        <col class="col19">
        <col class="col20">
        <col class="col21">
        <col class="col22">
        <col class="col23">
        <col class="col24">
        <col class="col25">
        <col class="col26">
        <col class="col27">
        <col class="col28">
        <col class="col29">
        <col class="col30">
        <col class="col31">
        <col class="col32">
        <col class="col33">
        <col class="col34">
        <col class="col35">
        <col class="col36">
        <col class="col37">
        <col class="col38">
        <col class="col39">
        <col class="col40">
        <col class="col41">
        <col class="col42">
        <col class="col43">
        <col class="col44">
        <col class="col45">
        <col class="col46">
        <col class="col47">
        <col class="col48">
        <col class="col49">
        <col class="col50">
        <col class="col51">
        <col class="col52">
        <col class="col53">
        <col class="col54">
        <col class="col55">
        <col class="col56">
        <tbody>
            <tr class="row0">
                <td class="column0 style18 null"></td>
                <td class="column1 style18 null"></td>
                <td class="column2 style18 null"></td>
                <td class="column3 style18 null"></td>
                <td class="column4 style18 null"></td>
                <td class="column5 style18 null"></td>
                <td class="column6 style18 null"></td>
                <td class="column7 style18 null"></td>
                <td class="column8 style18 null"></td>
                <td class="column9 style18 null"></td>
                <td class="column10 style18 null"></td>
                <td class="column11 style18 null"></td>
                <td class="column12 style18 null"></td>
                <td class="column13 style18 null"></td>
                <td class="column14 style18 null"></td>
                <td class="column15 style18 null"></td>
                <td class="column16 style18 null"></td>
                <td class="column17 style18 null"></td>
                <td class="column18 style18 null"></td>
                <td class="column19 style18 null"></td>
                <td class="column20 style18 null"></td>
                <td class="column21 style18 null"></td>
                <td class="column22 style18 null"></td>
                <td class="column23 style18 null"></td>
                <td class="column24 style18 null"></td>
                <td class="column25 style18 null"></td>
                <td class="column26 style18 null"></td>
                <td class="column27 style18 null"></td>
                <td class="column28 style18 null"></td>
                <td class="column29 style18 null"></td>
                <td class="column30 style18 null"></td>
                <td class="column31 style18 null"></td>
                <td class="column32 style18 null"></td>
                <td class="column33 style18 null"></td>
                <td class="column34 style18 null"></td>
                <td class="column35 style18 null"></td>
                <td class="column36 style18 null"></td>
                <td class="column37 style18 null"></td>
                <td class="column38 style18 null"></td>
                <td class="column39 style18 null"></td>
                <td class="column40 style18 null"></td>
                <td class="column41 style18 null"></td>
                <td class="column42 style18 null"></td>
                <td class="column43 style18 null"></td>
                <td class="column44 style18 null"></td>
                <td class="column45 style18 null"></td>
                <td class="column46 style18 null"></td>
                <td class="column47 style18 null"></td>
                <td class="column48 style18 null"></td>
                <td class="column49 style18 null"></td>
                <td class="column50 style18 null"></td>
                <td class="column51 style18 null"></td>
                <td class="column52 style18 null"></td>
                <td class="column53 style18 null"></td>
                <td class="column54 style18 null"></td>
                <td class="column55 style18 null"></td>
                <td class="column56 style18 null"></td>
            </tr>
            <tr class="row1">
                <td class="column0 style133 s style134" colspan="11">COMMISSION
                    TECHNIQUE D'EVALUATION SALAMA</td>
                <td class="column11 style19 null"></td>
                <td class="column12 style19 null"></td>
                <td class="column13 style19 null"></td>
                <td class="column14 style19 null"></td>
                <td class="column15 style19 null"></td>
                <td class="column16 style19 null"></td>
                <td class="column17 style19 null"></td>
                <td class="column18 style19 null"></td>
                <td class="column19 style19 null"></td>
                <td class="column20 style19 null"></td>
                <td class="column21 style19 null"></td>
                <td class="column22 style19 null"></td>
                <td class="column23 style19 null"></td>
                <td class="column24 style19 null"></td>
                <td class="column25 style19 null"></td>
                <td class="column26 style19 null"></td>
                <td class="column27 style19 null"></td>
                <td class="column28 style19 null"></td>
                <td class="column29 style19 null"></td>
                <td class="column30 style19 null"></td>
                <td class="column31 style19 null"></td>
                <td class="column32 style19 null"></td>
                <td class="column33 style19 null"></td>
                <td class="column34 style19 null"></td>
                <td class="column35 style19 null"></td>
                <td class="column36 style19 null"></td>
                <td class="column37 style19 null"></td>
                <td class="column38 style19 null"></td>
                <td class="column39 style19 null"></td>
                <td class="column40 style19 null"></td>
                <td class="column41 style19 null"></td>
                <td class="column42 style19 null"></td>
                <td class="column43 style19 null"></td>
                <td class="column44 style19 null"></td>
                <td class="column45 style19 null"></td>
                <td class="column46 style19 null"></td>
                <td class="column47 style19 null"></td>
                <td class="column48 style19 null"></td>
                <td class="column49 style19 null"></td>
                <td class="column50 style19 null"></td>
                <td class="column51 style19 null"></td>
                <td class="column52 style19 null"></td>
                <td class="column53 style19 null"></td>
                <td class="column54 style19 null"></td>
                <td class="column55 style20 null"></td>
                <td class="column56 style18 null"></td>
            </tr>
            <tr class="row2">
                <td class="column0 style133 s style134" colspan="15">APPEL D'OFFRE
                    INTERNATIONAL DE PREQUALIFICATION N° </td>
                <td class="column15 style130 s style132" colspan="5">:</td>
                <td class="column20 style19 null"></td>
                <td class="column21 style19 null"></td>
                <td class="column22 style19 null"></td>
                <td class="column23 style19 null"></td>
                <td class="column24 style19 null"></td>
                <td class="column25 style19 null"></td>
                <td class="column26 style19 null"></td>
                <td class="column27 style19 null"></td>
                <td class="column28 style19 null"></td>
                <td class="column29 style19 null"></td>
                <td class="column30 style19 null"></td>
                <td class="column31 style19 null"></td>
                <td class="column32 style19 null"></td>
                <td class="column33 style135 s style134" colspan="22">MEDICAMENTS</td>
                <td class="column55 style19 null"></td>
                <td class="column56 style18 null"></td>
            </tr>
            <tr class="row3">
                <td class="column0 style133 s style134" colspan="8">SESSION
                    D'EVALUATION DE </td>
                <td class="column8 style19 null"></td>
                <td class="column9 style19 null"></td>
                <td class="column10 style19 null"></td>
                <td class="column11 style19 null"></td>
                <td class="column12 style19 null"></td>
                <td class="column13 style19 null"></td>
                <td class="column14 style19 null"></td>
                <td class="column15 style19 null"></td>
                <td class="column16 style19 null"></td>
                <td class="column17 style19 null"></td>
                <td class="column18 style19 null"></td>
                <td class="column19 style19 null"></td>
                <td class="column20 style19 null"></td>
                <td class="column21 style19 null"></td>
                <td class="column22 style19 null"></td>
                <td class="column23 style19 null"></td>
                <td class="column24 style19 null"></td>
                <td class="column25 style19 null"></td>
                <td class="column26 style19 null"></td>
                <td class="column27 style136 s style134" colspan="29">PRODUITS
                    PREQUALIFIES OMS - PAYS ICH &amp; PIC/s : ADMIS D'OFFICE</td>
                <td class="column56 style18 null"></td>
            </tr>
            <tr class="row4">
                <td class="column0 style21 null"></td>
                <td class="column1 style19 null"></td>
                <td class="column2 style19 null"></td>
                <td class="column3 style19 null"></td>
                <td class="column4 style22 null"></td>
                <td class="column5 style19 null"></td>
                <td class="column6 style19 null"></td>
                <td class="column7 style19 null"></td>
                <td class="column8 style19 null"></td>
                <td class="column9 style19 null"></td>
                <td class="column10 style19 null"></td>
                <td class="column11 style19 null"></td>
                <td class="column12 style19 null"></td>
                <td class="column13 style19 null"></td>
                <td class="column14 style19 null"></td>
                <td class="column15 style19 null"></td>
                <td class="column16 style19 null"></td>
                <td class="column17 style19 null"></td>
                <td class="column18 style19 null"></td>
                <td class="column19 style19 null"></td>
                <td class="column20 style19 null"></td>
                <td class="column21 style19 null"></td>
                <td class="column22 style19 null"></td>
                <td class="column23 style19 null"></td>
                <td class="column24 style19 null"></td>
                <td class="column25 style19 null"></td>
                <td class="column26 style19 null"></td>
                <td class="column27 style19 null"></td>
                <td class="column28 style19 null"></td>
                <td class="column29 style19 null"></td>
                <td class="column30 style19 null"></td>
                <td class="column31 style19 null"></td>
                <td class="column32 style19 null"></td>
                <td class="column33 style19 null"></td>
                <td class="column34 style19 null"></td>
                <td class="column35 style19 null"></td>
                <td class="column36 style19 null"></td>
                <td class="column37 style19 null"></td>
                <td class="column38 style19 null"></td>
                <td class="column39 style19 null"></td>
                <td class="column40 style19 null"></td>
                <td class="column41 style19 null"></td>
                <td class="column42 style19 null"></td>
                <td class="column43 style19 null"></td>
                <td class="column44 style19 null"></td>
                <td class="column45 style19 null"></td>
                <td class="column46 style19 null"></td>
                <td class="column47 style19 null"></td>
                <td class="column48 style19 null"></td>
                <td class="column49 style19 null"></td>
                <td class="column50 style19 null"></td>
                <td class="column51 style19 null"></td>
                <td class="column52 style19 null"></td>
                <td class="column53 style19 null"></td>
                <td class="column54 style19 null"></td>
                <td class="column55 style20 null"></td>
                <td class="column56 style18 null"></td>
            </tr>
            <tr class="row5">
                <td class="column0 style133 s style129" colspan="5">NOM DU
                    SOUMISSIONNAIRE </td>
                <td class="column5 style137 s style132" colspan="6">:</td>
                <td class="column11 style19 null"></td>
                <td class="column12 style127 s style129" colspan="5">ORIGINE </td>
                <td class="column17 style130 s style132" colspan="9">:</td>
                <td class="column26 style19 null"></td>
                <td class="column27 style19 null"></td>
                <td class="column28 style19 null"></td>
                <td class="column29 style127 s style129" colspan="6">GROSSISTE</td>
                <td class="column35 style130 s style132" colspan="2">:</td>
                <td class="column37 style19 null"></td>
                <td class="column38 style19 null"></td>
                <td class="column39 style19 null"></td>
                <td class="column40 style19 null"></td>
                <td class="column41 style19 null"></td>
                <td class="column42 style19 null"></td>
                <td class="column43 style19 null"></td>
                <td class="column44 style19 null"></td>
                <td class="column45 style19 null"></td>
                <td class="column46 style19 null"></td>
                <td class="column47 style19 null"></td>
                <td class="column48 style19 null"></td>
                <td class="column49 style19 null"></td>
                <td class="column50 style19 null"></td>
                <td class="column51 style19 null"></td>
                <td class="column52 style19 null"></td>
                <td class="column53 style19 null"></td>
                <td class="column54 style19 null"></td>
                <td class="column55 style20 null"></td>
                <td class="column56 style18 null"></td>
            </tr>
            <tr class="row6">
                <td class="column0 style133 s style129" colspan="5">DATE</td>
                <td class="column5 style138 s style132" colspan="6">:</td>
                <td class="column11 style19 null"></td>
                <td class="column12 style127 s style129" colspan="5">OFFRE N°</td>
                <td class="column17 style130 s style132" colspan="9">:</td>
                <td class="column26 style19 null"></td>
                <td class="column27 style19 null"></td>
                <td class="column28 style19 null"></td>
                <td class="column29 style127 s style129" colspan="6">FABRICANT </td>
                <td class="column35 style130 s style132" colspan="2">:</td>
                <td class="column37 style19 null"></td>
                <td class="column38 style19 null"></td>
                <td class="column39 style19 null"></td>
                <td class="column40 style19 null"></td>
                <td class="column41 style19 null"></td>
                <td class="column42 style19 null"></td>
                <td class="column43 style19 null"></td>
                <td class="column44 style19 null"></td>
                <td class="column45 style19 null"></td>
                <td class="column46 style19 null"></td>
                <td class="column47 style19 null"></td>
                <td class="column48 style19 null"></td>
                <td class="column49 style19 null"></td>
                <td class="column50 style19 null"></td>
                <td class="column51 style19 null"></td>
                <td class="column52 style19 null"></td>
                <td class="column53 style19 null"></td>
                <td class="column54 style19 null"></td>
                <td class="column55 style20 null"></td>
                <td class="column56 style18 null"></td>
            </tr>
            <tr class="row7">
                <td class="column0 style23 null"></td>
                <td class="column1 style23 null"></td>
                <td class="column2 style23 null"></td>
                <td class="column3 style23 null"></td>
                <td class="column4 style24 null"></td>
                <td class="column5 style23 null"></td>
                <td class="column6 style23 null"></td>
                <td class="column7 style23 null"></td>
                <td class="column8 style23 null"></td>
                <td class="column9 style23 null"></td>
                <td class="column10 style23 null"></td>
                <td class="column11 style23 null"></td>
                <td class="column12 style23 null"></td>
                <td class="column13 style23 null"></td>
                <td class="column14 style23 null"></td>
                <td class="column15 style23 null"></td>
                <td class="column16 style23 null"></td>
                <td class="column17 style23 null"></td>
                <td class="column18 style23 null"></td>
                <td class="column19 style23 null"></td>
                <td class="column20 style23 null"></td>
                <td class="column21 style23 null"></td>
                <td class="column22 style23 null"></td>
                <td class="column23 style23 null"></td>
                <td class="column24 style23 null"></td>
                <td class="column25 style23 null"></td>
                <td class="column26 style23 null"></td>
                <td class="column27 style23 null"></td>
                <td class="column28 style23 null"></td>
                <td class="column29 style23 null"></td>
                <td class="column30 style23 null"></td>
                <td class="column31 style23 null"></td>
                <td class="column32 style23 null"></td>
                <td class="column33 style23 null"></td>
                <td class="column34 style23 null"></td>
                <td class="column35 style23 null"></td>
                <td class="column36 style23 null"></td>
                <td class="column37 style23 null"></td>
                <td class="column38 style23 null"></td>
                <td class="column39 style23 null"></td>
                <td class="column40 style23 null"></td>
                <td class="column41 style23 null"></td>
                <td class="column42 style23 null"></td>
                <td class="column43 style23 null"></td>
                <td class="column44 style23 null"></td>
                <td class="column45 style23 null"></td>
                <td class="column46 style23 null"></td>
                <td class="column47 style23 null"></td>
                <td class="column48 style23 null"></td>
                <td class="column49 style23 null"></td>
                <td class="column50 style23 null"></td>
                <td class="column51 style23 null"></td>
                <td class="column52 style23 null"></td>
                <td class="column53 style23 null"></td>
                <td class="column54 style23 null"></td>
                <td class="column55 style25 null"></td>
                <td class="column56 style26 null"></td>
            </tr>
            <tr class="row8">
                <td class="column0 style175 s style176" rowspan="3">N° ITEM</td>
                <td class="column1 style178 s style152" rowspan="3">NOM DU
                    PRODUIT</td>
                <td class="column2 style154 s style152" rowspan="3">CONDITIONNEMENT</td>
                <td class="column3 style181 s style182" rowspan="3">NOM DU LABORATOIRE
                    FABRICANT</td>
                <td class="column4 style172 s style174" colspan="21">FABRICANT</td>
                <td class="column25 style179 s style174" colspan="5">ENREGISTREMENT</td>
                <td class="column30 style172 s style180" colspan="22">PRODUIT
                    FINI</td>
                <td class="column52 style151 s style152" rowspan="2">DT</td>
                <td class="column53 style154 s style152" rowspan="2">APPRECIATION
                    QUALITE TECHNIQUE PAR LES UTILISATEURS</td>
                <td class="column54 style155 s style156" rowspan="2">TOTAL DES
                    POINTS</td>
                <td class="column55 style178 s style152" rowspan="5">OBSERVATIONS</td>
                <td class="column56 style191 s style168" rowspan="5">DECISION</td>
            </tr>
            <tr class="row9">
                <td class="column4 style158 s style158">AUTORISATION D'EXERCICE
                    DELIVREE PAR LE MINISTERE DE LA SANTE (FABRICANTS ET GROSSITES)</td>
                <td class="column5 style141 s style143" colspan="5">STATUT BPF</td>
                <td class="column10 style158 s style158">LETTRE D'AGREMENT OU
                    CERTIFICAT DE NEGOCE ATTESTANT LEUR QUALITE DE DISTRIBUTEUR AGREE
                    (GROSSISTE)</td>
                <td class="column11 style139 s style139">LETTRE DE SOUMISSION SIGNEE
                    ET CACHETEE</td>
                <td class="column12 style139 s style139">R.C. STAT NIF CP</td>
                <td class="column13 style139 s style139">ATTESTATION FISCALE</td>
                <td class="column14 style139 s style139">CONTENU QUESTIONNAIRE
                    FOURNISSEUR</td>
                <td class="column15 style141 s style143" colspan="5">SITE DE
                    FABRICATION</td>
                <td class="column20 style147 s style143" colspan="5">PRESENTATION DE
                    L'OFFRE</td>
                <td class="column25 style141 s style143" colspan="5">ENREGISTREMENT</td>
                <td class="column30 style139 s style139">COPP</td>
                <td class="column31 style139 s style139">CERTIFICAT D'ANALYSE</td>
                <td class="column32 style139 s style139">PRODUIT AYANT FAIT L'OBJET DE
                    RECLAMATIONS QUALITES</td>
                <td class="column33 style141 s style143" colspan="5">PHARMACOPEE +
                    MONOGRAPHIE PF</td>
                <td class="column38 style141 s style143" colspan="5">SUBSTANCE
                    ACTIVE</td>
                <td class="column43 style141 s style143" colspan="4">STABILITE</td>
                <td class="column47 style141 s style192" colspan="5">NOTICE -
                    CONDITIONNEMENT - ETIQUETAGE</td>
            </tr>
            <tr class="row11">
                <td class="column4 style184 n style185" rowspan="3">4</td>
                <td class="column5 style148 n style150" colspan="5">8</td>
                <td class="column10 style159 null style164" colspan="2" rowspan="3"></td>
                <td class="column12 style165 n style166" rowspan="3">2</td>
                <td class="column13 style165 n style166" rowspan="3">2</td>
                <td class="column14 style165 n style166" rowspan="3">2</td>
                <td class="column15 style170 n style150" colspan="5">12</td>
                <td class="column20 style170 n style150" colspan="5">4</td>
                <td class="column25 style170 n style150" colspan="5">8</td>
                <td class="column30 style165 n style166" rowspan="3">2</td>
                <td class="column31 style165 n style166" rowspan="3">2</td>
                <td class="column32 style194 null style195" rowspan="3"></td>
                <td class="column33 style170 n style150" colspan="5">16</td>
                <td class="column38 style170 n style150" colspan="5">8</td>
                <td class="column43 style148 n style150" colspan="4">4</td>
                <td class="column47 style170 n style150" colspan="5">16</td>
                <td class="column52 style196 n style166" rowspan="3">86</td>
                <td class="column53 style196 n style166" rowspan="3">10</td>
                <td class="column54 style167 f style169" rowspan="3"></td>
            </tr>
            <tr class="row12">
                <td class="column0 style186 s style187" colspan="4">NIVEAU</td>
                <td class="column5 style27 n">0</td>
                <td class="column6 style27 n">1</td>
                <td class="column7 style28 n">2</td>
                <td class="column8 style27 n">3</td>
                <td class="column9 style27 n">4</td>
                <td class="column15 style27 n">0</td>
                <td class="column16 style28 n">1</td>
                <td class="column17 style27 n">2</td>
                <td class="column18 style27 n">3</td>
                <td class="column19 style27 n">4</td>
                <td class="column20 style171 null style132" colspan="5"></td>
                <td class="column25 style27 n">0</td>
                <td class="column26 style28 n">1</td>
                <td class="column27 style27 n">2</td>
                <td class="column28 style27 n">3</td>
                <td class="column29 style27 n">4</td>
                <td class="column33 style27 n">0</td>
                <td class="column34 style27 n">1</td>
                <td class="column35 style28 n">2</td>
                <td class="column36 style29 n">3</td>
                <td class="column37 style27 n">4</td>
                <td class="column38 style27 n">0</td>
                <td class="column39 style27 n">1</td>
                <td class="column40 style28 n">2</td>
                <td class="column41 style27 n">3</td>
                <td class="column42 style27 n">4</td>
                <td class="column43 style27 n">0</td>
                <td class="column44 style28 n">1</td>
                <td class="column45 style27 n">2</td>
                <td class="column46 style27 n">3</td>
                <td class="column47 style27 n">0</td>
                <td class="column48 style27 n">1</td>
                <td class="column49 style28 n">2</td>
                <td class="column50 style27 n">3</td>
                <td class="column51 style27 n">4</td>
            </tr>
            <tr class="row13">
                <td class="column0 style188 s style190" colspan="4">SCORE</td>
                <td class="column5 style30 n">0</td>
                <td class="column6 style30 n">2</td>
                <td class="column7 style31 n">4</td>
                <td class="column8 style30 n">6</td>
                <td class="column9 style30 n">8</td>
                <td class="column15 style30 n">0</td>
                <td class="column16 style31 n">6</td>
                <td class="column17 style30 n">8</td>
                <td class="column18 style30 n">10</td>
                <td class="column19 style30 n">12</td>
                <td class="column20 style30 n">0</td>
                <td class="column21 style30 n">1</td>
                <td class="column22 style30 n">2</td>
                <td class="column23 style30 n">3</td>
                <td class="column24 style30 n">4</td>
                <td class="column25 style30 n">0</td>
                <td class="column26 style31 n">2</td>
                <td class="column27 style30 n">4</td>
                <td class="column28 style30 n">6</td>
                <td class="column29 style30 n">8</td>
                <td class="column33 style30 n">0</td>
                <td class="column34 style30 n">4</td>
                <td class="column35 style31 n">8</td>
                <td class="column36 style32 n">12</td>
                <td class="column37 style30 n">16</td>
                <td class="column38 style30 n">0</td>
                <td class="column39 style30 n">2</td>
                <td class="column40 style31 n">4</td>
                <td class="column41 style30 n">6</td>
                <td class="column42 style30 n">8</td>
                <td class="column43 style30 n">0</td>
                <td class="column44 style31 n">1</td>
                <td class="column45 style30 n">2</td>
                <td class="column46 style30 n">4</td>
                <td class="column47 style30 n">0</td>
                <td class="column48 style30 n">4</td>
                <td class="column49 style31 n">8</td>
                <td class="column50 style30 n">12</td>
                <td class="column51 style30 n">16</td>
            </tr>
            <tr class="row14">
                <td class="column0 style33 null"></td>
                <td class="column1 style34 null"></td>
                <td class="column2 style33 null"></td>
                <td class="column3 style35 null"></td>
                <td class="column4 style36 null"></td>
                <td class="column5 style33 null"></td>
                <td class="column6 style33 null"></td>
                <td class="column7 style37 null"></td>
                <td class="column8 style33 null"></td>
                <td class="column9 style33 null"></td>
                <td class="column10 style33 null"></td>
                <td class="column11 style33 null"></td>
                <td class="column12 style33 null"></td>
                <td class="column13 style33 null"></td>
                <td class="column14 style33 null"></td>
                <td class="column15 style33 null"></td>
                <td class="column16 style37 null"></td>
                <td class="column17 style33 null"></td>
                <td class="column18 style33 null"></td>
                <td class="column19 style33 null"></td>
                <td class="column20 style33 null"></td>
                <td class="column21 style33 null"></td>
                <td class="column22 style33 null"></td>
                <td class="column23 style33 null"></td>
                <td class="column24 style33 null"></td>
                <td class="column25 style33 null"></td>
                <td class="column26 style37 null"></td>
                <td class="column27 style33 null"></td>
                <td class="column28 style33 null"></td>
                <td class="column29 style33 null"></td>
                <td class="column30 style33 null"></td>
                <td class="column31 style33 null"></td>
                <td class="column32 style33 null"></td>
                <td class="column33 style33 null"></td>
                <td class="column34 style33 null"></td>
                <td class="column35 style37 null"></td>
                <td class="column36 style33 null"></td>
                <td class="column37 style33 null"></td>
                <td class="column38 style33 null"></td>
                <td class="column39 style33 null"></td>
                <td class="column40 style37 null"></td>
                <td class="column41 style33 null"></td>
                <td class="column42 style33 null"></td>
                <td class="column43 style33 null"></td>
                <td class="column44 style37 null"></td>
                <td class="column45 style33 null"></td>
                <td class="column46 style33 null"></td>
                <td class="column47 style33 null"></td>
                <td class="column48 style33 null"></td>
                <td class="column49 style37 null"></td>
                <td class="column50 style33 null"></td>
                <td class="column51 style33 null"></td>
                <td class="column52 style38 f">0</td>
                <td class="column53 style36 null"></td>
                <td class="column54 style39 f">0</td>
                <td class="column55 style40 null"></td>
                <td class="column56 style33 null"></td>
            </tr>
            <tr class="row15">
                <td class="column0 style41 null"></td>
                <td class="column1 style42 null"></td>
                <td class="column2 style41 null"></td>
                <td class="column3 style43 null"></td>
                <td class="column4 style44 null"></td>
                <td class="column5 style41 null"></td>
                <td class="column6 style41 null"></td>
                <td class="column7 style45 null"></td>
                <td class="column8 style41 null"></td>
                <td class="column9 style41 null"></td>
                <td class="column10 style41 null"></td>
                <td class="column11 style41 null"></td>
                <td class="column12 style41 null"></td>
                <td class="column13 style41 null"></td>
                <td class="column14 style41 null"></td>
                <td class="column15 style41 null"></td>
                <td class="column16 style45 null"></td>
                <td class="column17 style41 null"></td>
                <td class="column18 style41 null"></td>
                <td class="column19 style41 null"></td>
                <td class="column20 style41 null"></td>
                <td class="column21 style41 null"></td>
                <td class="column22 style41 null"></td>
                <td class="column23 style41 null"></td>
                <td class="column24 style41 null"></td>
                <td class="column25 style41 null"></td>
                <td class="column26 style45 null"></td>
                <td class="column27 style41 null"></td>
                <td class="column28 style41 null"></td>
                <td class="column29 style41 null"></td>
                <td class="column30 style41 null"></td>
                <td class="column31 style41 null"></td>
                <td class="column32 style41 null"></td>
                <td class="column33 style41 null"></td>
                <td class="column34 style41 null"></td>
                <td class="column35 style45 null"></td>
                <td class="column36 style41 null"></td>
                <td class="column37 style41 null"></td>
                <td class="column38 style41 null"></td>
                <td class="column39 style41 null"></td>
                <td class="column40 style45 null"></td>
                <td class="column41 style41 null"></td>
                <td class="column42 style41 null"></td>
                <td class="column43 style41 null"></td>
                <td class="column44 style45 null"></td>
                <td class="column45 style41 null"></td>
                <td class="column46 style41 null"></td>
                <td class="column47 style41 null"></td>
                <td class="column48 style41 null"></td>
                <td class="column49 style45 null"></td>
                <td class="column50 style41 null"></td>
                <td class="column51 style41 null"></td>
                <td class="column52 style46 f">0</td>
                <td class="column53 style44 null"></td>
                <td class="column54 style47 f">0</td>
                <td class="column55 style42 null"></td>
                <td class="column56 style41 null"></td>
            </tr>
            <tr class="row16">
                <td class="column0 style43 null"></td>
                <td class="column1 style42 null"></td>
                <td class="column2 style48 null"></td>
                <td class="column3 style43 null"></td>
                <td class="column4 style44 null"></td>
                <td class="column5 style41 null"></td>
                <td class="column6 style41 null"></td>
                <td class="column7 style45 null"></td>
                <td class="column8 style41 null"></td>
                <td class="column9 style41 null"></td>
                <td class="column10 style41 null"></td>
                <td class="column11 style41 null"></td>
                <td class="column12 style41 null"></td>
                <td class="column13 style41 null"></td>
                <td class="column14 style41 null"></td>
                <td class="column15 style41 null"></td>
                <td class="column16 style45 null"></td>
                <td class="column17 style41 null"></td>
                <td class="column18 style41 null"></td>
                <td class="column19 style41 null"></td>
                <td class="column20 style41 null"></td>
                <td class="column21 style41 null"></td>
                <td class="column22 style41 null"></td>
                <td class="column23 style41 null"></td>
                <td class="column24 style41 null"></td>
                <td class="column25 style41 null"></td>
                <td class="column26 style45 null"></td>
                <td class="column27 style41 null"></td>
                <td class="column28 style41 null"></td>
                <td class="column29 style41 null"></td>
                <td class="column30 style41 null"></td>
                <td class="column31 style41 null"></td>
                <td class="column32 style41 null"></td>
                <td class="column33 style41 null"></td>
                <td class="column34 style41 null"></td>
                <td class="column35 style45 null"></td>
                <td class="column36 style41 null"></td>
                <td class="column37 style41 null"></td>
                <td class="column38 style41 null"></td>
                <td class="column39 style41 null"></td>
                <td class="column40 style45 null"></td>
                <td class="column41 style41 null"></td>
                <td class="column42 style41 null"></td>
                <td class="column43 style41 null"></td>
                <td class="column44 style45 null"></td>
                <td class="column45 style41 null"></td>
                <td class="column46 style41 null"></td>
                <td class="column47 style41 null"></td>
                <td class="column48 style41 null"></td>
                <td class="column49 style45 null"></td>
                <td class="column50 style41 null"></td>
                <td class="column51 style41 null"></td>
                <td class="column52 style46 f">0</td>
                <td class="column53 style44 null"></td>
                <td class="column54 style47 f">0</td>
                <td class="column55 style42 null"></td>
                <td class="column56 style41 null"></td>
            </tr>

        </tbody>
    </table>
</body>

</html>