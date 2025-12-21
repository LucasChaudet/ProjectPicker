<?php

function asset(string $fileName): string {
    return "uploads/" . $fileName;
}


function get_header(string $page_title): void{
    require_once "assets/header.php";
}

function get_footer(): void{
    require_once "assets/footer.php";
}