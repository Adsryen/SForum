<?php
Itf_Setting()->add(
    2,
    "发信邮箱",
    "mail",
    "Mail::mail");
menu()->add(1791,[
	'name' => "邮箱设置",
	'url' => '/admin/mail',
	'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <rect x="3" y="5" width="18" height="14" rx="2"></rect>
   <polyline points="3 7 12 13 21 7"></polyline>
</svg>'
]);