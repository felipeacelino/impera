<style>
/* COR PRINCIPAL */
body, .left_col, .nav_title, .nav-sm ul.nav.child_menu, .sidebar-footer, .sidebar-footer a, .nav.side-menu > li.active > a, .pagination-nav .pagination>li.active>a {
  background: <?=COR_PRINCIPAL?> !important;
} 
.toggle a i {
  color: <?=COR_PRINCIPAL?> !important;
}
/* COR SECUNDARIA */
#nprogress .bar, .sidebar-footer a:hover, .daterangepicker td.active, .daterangepicker td.active:hover, div.tagsinput span.tag, .dropdown-menu > li > a.active, .nav-md ul.nav.child_menu li:before, .bg-orange  {
  background: <?=COR_SECUNDARIA?> !important;
}
.site_title i, .x_panel > h1 > i, .ms-drop ul > li.selected label span:before, .control-label small i.fas {
  color: <?=COR_SECUNDARIA?> !important;
}
#nprogress .peg {
  box-shadow: 0 0 10px <?=COR_SECUNDARIA?>, 0 0 5px <?=COR_SECUNDARIA?> !important; 
}
#nprogress .spinner-icon {
  border-top-color: <?=COR_SECUNDARIA?> !important;
  border-left-color: <?=COR_SECUNDARIA?> !important; 
}
.nav-sm .nav.child_menu li.active,
.nav-sm .nav.side-menu li.active-sm,
.nav.side-menu > li.current-page, .nav.side-menu > li.active {
  border-right: 5px solid <?=COR_SECUNDARIA?> !important; 
}
.nav-md ul.nav.child_menu li:after, .bg-orange { 
  border-color: <?=COR_SECUNDARIA?> !important;
}
.tag:after { border-left: 11px solid <?=COR_SECUNDARIA?> !important; }
/* BOTAO PRINCIPAL */
.btn-primary {
  background-color: <?=BTN_SECUNDARIO?> !important;
  border-color: <?=BTN_SECUNDARIO?> !important;
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
  background-color: <?=BTN_SECUNDARIO?> !important;
  border-color: <?=BTN_SECUNDARIO?> !important;
}
/* BOTAO SECUNDARIO */
.btn-success {
  background-color: <?=BTN_PRINCIPAL?> !important;
  border-color: <?=BTN_PRINCIPAL?> !important;
}
.btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .open .dropdown-toggle.btn-success {
  background-color: <?=BTN_PRINCIPAL?> !important;
  border-color: <?=BTN_PRINCIPAL?> !important;
}  
/* CHECKBOX / RADIO */
.check:hover span {
  border-color: <?=COR_ICHECK?> !important;
}
.check input:checked + span {
  background: <?=COR_ICHECK?> !important;
  border-color: <?=COR_ICHECK?> !important;
}
</style>
