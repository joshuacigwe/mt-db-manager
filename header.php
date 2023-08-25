<?php
include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/config.php');
include($_SERVER["DOCUMENT_ROOT"]. '/mt-db-manager/class/mt-db-manager.php');
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $page_title;?> | Mastertools Wizard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/mt-db-manager/assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="/mt-db-manager/assets/img/mastertools-logo.png">

<?php
if($page_head=="resources") {
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>

<!-- and it's easy to individually load additional languages -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/go.min.js"></script>

<script>hljs.highlightAll();</script>
<?php } ?>

<style>
body {
    background: #fcfdfe;
    overflow-y: scroll;
}

a {
    color: #4581c3;
}

.mt-header {
    position: sticky;
    top: 0;
    z-index: 99;
}

.navbar-brand {
    color: #fff;
    font-family: sans-serif;
    display: flex;
    align-items: center;
}

.mt-dash-logo {
    width: 40px;
    height: 40px;
    border-radius: 90px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 40px 40px;
    margin-right: 8px;
    border: 1px solid #ffffff;
}

.mt-wizard-main {
    border: 1px solid #ccc;
    padding: 5px 20px 30px;
    margin: 0 0 25px;
    background: #ffffff;
}

.mt-wizard-main-inner {
    min-height: 470px;
}

.bg-light {
    background-color: #133a69!important;
}

.navbar-light .navbar-nav .nav-link {
    color: #fff;
    border-right: 1px solid #7a8490;
    padding: 0 12px;
    font-size: 15px;
    min-width: 93px;
    text-align: center;
}

.navbar-nav .nav-item:first-child a.nav-link {
    border-left: 1px solid #7a8490;
}

.navbar-light .navbar-nav .active>.nav-link, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .show>.nav-link {
    color: #91d8f7;
}

.navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
    color: #d6ebf5;
}

nav.navbar.navbar-expand-lg.navbar-light.bg-light {
    padding-top: 0;
    padding-bottom: 0;
}

/**/

.mt-database-tool-inner {
    padding: 20px 20px 25px;
}

.form-group {
    margin-bottom: 20px;
}

.form-control {
    background: #e8edee;
}

.form-input.textarea {
    height: auto;
}

.form-btn {
    border: 1px solid #009688;
    padding: 12px 20px;
    font-size: 15px;
    background: #009688;
    color: #fff;
    cursor: pointer;
}

.response-data {
    background: #4CAF50;
    color: #fff;
    padding: 9px 10px;
    font-size: 14px;
    border-radius: 2px;
    margin-bottom: 15px;
}

.mt-header-nav-ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center;
}

form.mt-search-form {
    position: relative;
}

button.mt-search-btn {
    position: absolute;
    right: 0;
    border: none;
    padding: 15px 15px 10px;
    background: none !important;
}

button.mt-search-btn svg.feather.feather-search {
    color: #133a69;
}

.mt-tb-link:first-child {
    margin-right: 15px;
}

.mt-dbt-ul {
    list-style-type: auto;
}

.mt-dbt-li {
    margin-bottom: 3px;
}

.mt-dbt-li-inner {
    display: flex;
    flex-wrap: wrap;
    align-content: center;
}

.mt-dbt-action {
    display: flex;
    align-items: center;
    margin-left: 7px;
}

.mt-dbt-a-btn {
    background: #ddd;
    border-radius: 90px;
    text-align: center;
    margin: 0 3px;
    color: #fff;
    display: block;
    width: 30px;
    height: 18px;
}

.mt-dbt-a-btn.mt-dbt-add {
    background: #28a745;
}

.mt-dbt-a-btn.mt-dbt-insert {
    background: #007bff;
}

.mt-dbt-a-btn.mt-dbt-del {
    background: #dc3545;
}

.mt-dbt-a-btn svg {
    position: relative;
    bottom: 2px;
}

.mt-wiz-heading {
    border-bottom: 1px solid #ccc;
    margin: 0 0 15px;
}

.mt-wiz-heading-txt {
    font-size: 20px;
}

.mt-wiz-heading-txt .mt-migo {
    color: #136ccf;
    font-weight: 500;
}

.error {
    border: 1px solid red;
}

.mt-wizard-heading {
    border-bottom: 1px dotted #133a69;
}

.mt-wizard-heading-txt {
    margin: 10px 0 0;
    font-size: 25px;
}

/*///////////////*/
.second a:hover {
    color: rgb(0, 183, 255) !important;
}

.active-2 {
    color: rgb(0, 183, 255) !important;
}

.breadcrumb>li+li:before {
    content: "" !important;
    padding-right: 2px !important;
    padding-left: 2px !important;
}

.breadcrumb {
    padding: 19px ;
    font-size: 14px;
    color: #aaa !important;
}

.breadcrumb-item .svg-angle {
    fill: #aaa;
}

a:focus, a:active {
   outline: none !important;
   box-shadow: none !important;
}

.mt-breadcrumb .breadcrumb {
    padding: 0;
    background: none;
}

.mt-breadcrumb .breadcrumb-item a.black-text {
    color: #111;
    font-size: 14px;
}

span.mt-brmb-span {
    margin-right: 4px;
}

a.mt-brmb-link.black-text {
    position: relative;
    bottom: 3px;
}

table.table {
    margin-top: 15px;
}

.mt-has-action {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

a.mt-res-btn {
    background: #009688;
    color: #fff;
    border-radius: 50px;
    font-size: 13px;
    padding: 4px 10px;
}


.code-container {
      border-radius: 5px;
      margin: 20px 0;
      overflow: auto;
      background-color: #000000;
}

span.hljs-name {
    color: #fff !important;
}

span.hljs-attr {
    color: #ac325e !important;
}

span.hljs-string {
    color: #4a9872 !important;
}

.hljs {
    background: #000;
    color: #fff;
}

span.hljs-tag {
    color: #c6cad1 !important;
}

pre code.hljs {
    padding: 0 2em;
}

a.mt-wd-txt-btn {
    background: #007bff;
    color: #fff;
    font-size: 14px;
    padding: 3px 10px;
    border-radius: 50px;
    margin: 0 0 10px;
    display: inline-block;
    min-width: 118px;
    text-align: center;
}

#generated_mapping {
   resize: none;
   overflow: hidden;
}

.auto-rows-group {
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding: 15px 0 0;
    margin: 0 0 20px;
}

.mt-push-btn {
    position: absolute;
    top: 2px;
    right: 0;
    bottom: 2px;
    cursor: pointer;
    border: none;
    background: #479789;
    color: #fff;
    padding: 0 15px;
    border-radius: 50px 0 0 50px;
    border-radius: 50px;
}

.mt-goright {
    text-align: right;
    margin: -5px 0 0;
}

div#error-message {
    display: none !important;
}

.form-group label {
    margin: 0;
}

.mt-form-heading {
    border-bottom: 1px solid #ccc;
    margin: 30px 0 25px;
}

.mt-form-heading-txt {
    font-weight: 300;
    margin: 0;
    color: #133a69;
}

span.mt-migo {
    color: #136ccf;
    font-weight: 500;
}

@media (max-width: 767px) {
.breadcrumb {
    font-size: 10px;
}

.breadcrumb-item+.breadcrumb-item {
    padding-left: 0;
}
           
.breadcrumb {
   letter-spacing: 1px !important;
}
    
.breadcrumb > * div {
   max-width: 60px;
}

body .navbar-light .navbar-toggler {
    color: #fff;
    border-color: #fff;
}
}

</style>
</head>
<body>

<header class="mt-header">
    <div class="container">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="/mt-db-manager">
              <span style="background-image: url(/mt-db-manager/assets/img/mastertools-logo.png);" class="mt-dash-logo"></span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item <?php if($page_head=="tables") {?>active<?php } ?>">
                <a class="nav-link" href="/mt-db-manager">Tables</a>
              </li>
              <li class="nav-item <?php if($page_head=="add-table") {?>active<?php } ?>">
                <a class="nav-link" href="/mt-db-manager/add-table">Add Table</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" data-src="/mt-db-manager/documentation">Documentation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/mt-db-manager/logout">Logout</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 mt-search-form">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0 mt-search-btn" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
              </button>
            </form>
          </div>
        </nav>
        
    </div>
</header>
