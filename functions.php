<?php

function asset(string $fileName): string {
    return "uploads/" . $fileName;
}


function get_header(string $page_title): void{
    require_once "header.php";
}

function get_footer(): void{
    require_once "footer.php";
}