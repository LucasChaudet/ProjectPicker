<?php

function asset(string $fileName): string {
    return "uploads/" . $fileName;
}