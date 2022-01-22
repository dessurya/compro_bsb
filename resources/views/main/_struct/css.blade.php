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
            transition: all .51s;
        }
        nav#header .navbar-brand img{
            height: 84px;
        }
        nav#header a{
            font-weight: 400;
            color: white !important;
            transition: all .51s;
        }
        nav#header a:hover{
            text-decoration: none;
            color: rgba(1,160,228,1) !important;
        }
        nav#header #lang{
            position: absolute;
            top:20px;
            right:40px;
            color: rgb(1 160 228);
        }
        
        nav#header.change.p-4 {
            padding: 0 1.8rem !important;
            background-color: rgba(229,240,234,.95);
            box-shadow: -2px 5px 8px rgba(229,240,234,40%);
        }
        nav#header.change .navbar-brand img{
            height: 60px;
            filter: drop-shadow(6px 6px 6px black);
        }
        nav#header.change #lang{
            top:-20px;
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
</style>