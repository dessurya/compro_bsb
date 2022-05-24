<link rel="stylesheet" href="{{ url('vendors\bootstrap\bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.2/css/all.min.css" integrity="sha512-g0gRzvKX9GBUbjlJZ02n2GLRJVabgLm6b3oypbkF6ne1T2+ZHCucKRd8qt31a3BCGahAlBmXUDS7lu2pYuWB7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
    html {
        scroll-behavior: smooth;
    }
    body{
        font-family: 'Open Sans', sans-serif;
        margin:0;
        padding:0;
        overflow-x: hidden;
        color: rgb(98 98 98);
    }
    .section{
        position: relative;
        width:100vw;
        padding: 4.4em 0;
        position: relative;
        margin: 0 auto;
    }
    .pos-abs{
        position: absolute;
    }
    .clearboth{
        clear: both
    }
    .fullScrenn{
        width:100vw;
        height:100vh;
    }
    .fullHeight{
        height:100vh;
    }
    .fullHeightPerc{
        height:100%;
    }
    .fullWidth{
        width:100vw;
    }
    .dis-tab {
        display: table;
    }
    .dis-tab-row {
        display: table-row;
    }
    .dis-tab-cell {
        display: table-cell;
    }
    .valg-mid{
        vertical-align: middle;
    }
    .valg-bot{
        vertical-align: bottom;
    }
    .valg-top{
        vertical-align: top;
    }
    .btn{
        font-weight: 600;
        text-transform: uppercase;
        border-radius: 1.75rem;
        padding: .675rem 3.75rem;
    }
    .btn-cstm-one{
        color: rgba(255,255,255,1);
        background-color: rgba(1,160,228,1);
        border-color: rgba(1,160,228,1);
        transition: all .51s;
    }
    .btn-cstm-one:hover{
        color: rgba(1,160,228,1);
        background-color: rgba(1,160,228,0);
        border-color: rgba(1,160,228,1);
    }
    h1.title-section span:nth-child(odd),
    h1.title-section-reverse span:nth-child(even){
        font-weight: 300;
    }
    h1.title-section span:nth-child(even),
    h1.title-section-reverse span:nth-child(odd){
        font-weight: 700;
    }

    /* navbar */
        nav#header{
            color: rgb(19 169 229) !important;
            transition: all .51s;
        }
        nav#header .navbar-brand img{
            height: 84px;
        }
        nav#header a{
            font-weight: 600;
            transition: all .51s;
        }
        nav#header a:hover{
            text-decoration: none;
        }
        nav#header #lang{
            position: absolute;
            top:10px;
            right:40px;
            color: rgb(1 160 228);
            transition: all .51s;
        }
        
        nav#header.change.p-4 {
            padding: 0 1.8rem !important;
            background-color: rgba(229,240,234,.95);
            box-shadow: -2px 5px 8px rgba(229,240,234,40%);
        }
        nav#header.change .navbar-brand img{
            height: 60px;
            /* filter: drop-shadow(6px 6px 6px black); */
        }
        nav#header.change #lang{
            top:50px;
        }
    /* navbar */

    /* footer */
        #footer #section-one{
            padding: 1.6em 0 3em;
            background-color: rgb(217,234,224);
            color: rgb(76,75,76);
        }
        #footer #section-one h3{
            font-weight: 700;
        }
        #footer #section-two{
            background-color: rgb(0,159,227);
            color: white;
            font-size: 10pt;
            font-weight: 600;
        }
        #footer p{
            margin:0;
            padding:0;
        }
        #footer .dis-tab-row{
            border-bottom: 15px solid transparent;
        }
        #footer .dis-tab-cell:nth-child(odd){
            width: 40px;
        }
        #footer #find img{
            cursor: pointer;
            float: right;
            height: 62px;
        }
    /* footer */
    

    /* scroll bar */
        /* scroller browser */
            ::-webkit-scrollbar {
                width: 5px;
            }
        /* scroller browser */

        /* Track */
            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 5px #d8eae0; 
                -webkit-border-radius: 10px;
                border-radius: 10px;
            }
        /* Track */

        /* Handle */
            ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #01a0e4;
            -webkit-box-shadow: inset 0 0 6px #d8eae0; 
            }
            ::-webkit-scrollbar-thumb:window-inactive {
            background: #d8eae0; 
            }
        /* Handle */
    /* scroll bar */

    #wrapper-btn-menu-toggle{
        display: none;
    }
    .btn-menu-toggle {
        background-color: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        padding: 0;
    }
    .btn-menu-toggle .line {
        fill: none;
        stroke: rgba(1,160,228,1);
        stroke-width: 4;
        transition: stroke-dasharray 600ms cubic-bezier(0.4, 0, 0.2, 1),
            stroke-dashoffset 600ms cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-menu-toggle .line1 {
        stroke-dasharray: 60 207;
        stroke-width: 4;
    }
    .btn-menu-toggle .line2 {
        stroke-dasharray: 60 60;
        stroke-width: 4;
    }
    .btn-menu-toggle .line3 {
        stroke-dasharray: 60 207;
        stroke-width: 4;
    }
    .btn-menu-toggle.opened .line1 {
        stroke-dasharray: 90 207;
        stroke-dashoffset: -134;
        stroke-width: 4;
    }
    .btn-menu-toggle.opened .line2 {
        stroke-dasharray: 1 60;
        stroke-dashoffset: -30;
        stroke-width: 4;
    }
    .btn-menu-toggle.opened .line3 {
        stroke-dasharray: 90 207;
        stroke-dashoffset: -134;
        stroke-width: 4;
    }

    @media (max-width: 568px){
        #wrapper-btn-menu-toggle{
            display: block;
        }
        nav#header {
            background-color: rgba(229,240,234,.95);
            box-shadow: -2px 5px 8px rgba(229,240,234,40%);
            padding: 0.5rem!important;
        }
        nav#header.change.p-4 {
            padding: 0.5rem!important;
        }
        #header .dis-tab,
        #header .dis-tab .dis-tab-row,
        #header .dis-tab .dis-tab-row .dis-tab-cell{
            display: block;
        }
        #header .flex-row{
            -webkit-box-orient: vertical!important;
            -webkit-box-direction: normal!important;
            -ms-flex-direction: column!important;
            flex-direction: column!important;
        }
        #header #menu{
            position: relative;
            top: -100vh;
            height: 0;
            transition: all .51s;
        }
        #header.show #menu{
            top: unset;
            height:unset;
        }
        nav#header .navbar-brand img,
        nav#header.change .navbar-brand img{
            height : 50px !important;
        }
        nav#header.change #lang,
        nav#header #lang{
            top: -10vh !important;
        }
        #header.show #lang{
            top: unset;
        }
    }
</style>