<link rel="stylesheet" href="{{ url('vendors\bootstrap\bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.2/css/all.min.css" integrity="sha512-g0gRzvKX9GBUbjlJZ02n2GLRJVabgLm6b3oypbkF6ne1T2+ZHCucKRd8qt31a3BCGahAlBmXUDS7lu2pYuWB7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    @font-face { 
        font-family:Adobe Caslon;
        src:url('{{ url('asset/font/ACaslonPro-Regular.otf') }}') format('opentype');
        font-display: auto;
    }
    @font-face {
        font-family:Adobe Clean;
        src:url('{{ url('asset/font/AdobeClean-Regular.woff') }}') format('woff');
        font-display: auto;
        }
    @font-face {
        font-family:Adobe Clean Bold;
        src:url('{{ url('asset/font/AdobeClean-Bold.ttf') }}') format('truetype');
        font-display: auto;
    }
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
        padding: 0;
        margin: 4em auto;
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
        /* font-weight: 300; */
        font-weight: 700;
        color: rgb(19 169 229);
    }
    h1.title-section span:nth-child(even),
    h1.title-section-reverse span:nth-child(odd){
        font-weight: 700;
        color: rgb(19 169 229);
    }

    /* navbar */
        nav#header{
            transition: all .51s;
            padding:3rem 4rem;
        }
        nav#header .navbar-brand img{
            height: 84px;
        }
        nav#header a{
            color: white !important;
            font-weight: 600;
            font-size: 12pt;
            transition: all .51s;
        }
        nav#header a:hover{
            text-decoration: none;
        }
        nav#header #lang{
            color: rgb(1 160 228);
            transition: all .51s;
        }
        nav#header #lang img{
            height: 30px;
        }
        
        nav#header.change {
            padding: 0 1.8rem !important;
            /* background-color: #01a0e4; */
            /* box-shadow: -2px 5px 8px rgba(229,240,234,40%); */
        }
        nav#header.change .navbar-brand img{
            height: 60px;
            /* filter: drop-shadow(6px 6px 6px black); */
        }
        nav#header.change #lang{
            top:55px;
        }
        nav#header #float-toggle-menu{
            position: fixed;
            top: 0;
            right: 0;
        }
        nav#header #float-toggle-menu.close #space{
            transition: all .51s;
            width: 0vw;
            background-color: rgba(0,0,0,0);
        }
        nav#header #float-toggle-menu.close #list{
            transition: all .51s;
            width: 0vw;
            background-color: rgba(0,0,0,0);
        }
        nav#header #float-toggle-menu #space{
            transition: all .51s;
            width: 68vw;
            background-color: rgba(0,0,0,.8);
        }
        nav#header #float-toggle-menu #list{
            transition: all .51s;
            width: 32vw;
            background-color: #01a0e4;
        }
        nav#header .list-group-item{
            background-color: rgba(0,0,0,0) !important;
            border: 0 !important;
        }
        nav#header #tools{
            position: relative;
            z-index: 100;
        }

        nav#header #wrapper-btn-menu-toggle{
            display: block;
            /* position: absolute;
            right: 10px;
            top: 10px; */
        }

        nav#header .btn-menu-toggle {
            background-color: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            padding: 0;
        }
        nav#header .btn-menu-toggle .line {
            fill: none;
            /* stroke: rgba(1,160,228,1); */
            stroke: white;
            stroke-width: 6;
            transition: stroke-dasharray 600ms cubic-bezier(0.4, 0, 0.2, 1),
                stroke-dashoffset 600ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        nav#header.change .btn-menu-toggle .line{
            stroke: #01a0e4;
        }
        nav#header.change .btn-menu-toggle.opened .line,
        nav#header .btn-menu-toggle.opened .line{
            stroke: white !important;
        }
        nav#header .btn-menu-toggle .line1 {
            stroke-dasharray: 60 207;
            stroke-width: 6;
        }
        nav#header .btn-menu-toggle .line2 {
            stroke-dasharray: 60 60;
            stroke-width: 6;
        }
        nav#header .btn-menu-toggle .line3 {
            stroke-dasharray: 60 207;
            stroke-width: 6;
        }
        nav#header .btn-menu-toggle.opened .line1 {
            stroke-dasharray: 90 207;
            stroke-dashoffset: -134;
            stroke-width: 6;
        }
        nav#header .btn-menu-toggle.opened .line2 {
            stroke-dasharray: 1 60;
            stroke-dashoffset: -30;
            stroke-width: 6;
        }
        nav#header .btn-menu-toggle.opened .line3 {
            stroke-dasharray: 90 207;
            stroke-dashoffset: -134;
            stroke-width: 6;
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

    @media (max-width: 805px){
        nav#header #float-toggle-menu #list{
            width:48vw;
        }
    }

    @media (max-width: 620px){
        nav#header .navbar-brand img{
            height:68px;
        }
    }

    @media (max-width: 570px){
        nav#header .navbar-brand img{
            height:56px;
        }
        nav#header #float-toggle-menu #list{
            width:52.5vw;
        }
    }
    @media (max-width: 420px){
        nav#header,
        nav#header.change{
            padding:1rem !important;
        }
        nav#header.change .navbar-brand img{
            height:53px;
        }
        nav#header #tools{
            background-color: rgba(0,0,0,0.2);
        }
        nav#header .navbar-brand img{
            height:53px;
        }
        nav#header #float-toggle-menu #list{
            padding:0 !important;
            width:100vw;
        }
    }
</style>