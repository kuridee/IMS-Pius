<?php

class PageController
{
    public function home(): void
    {
        require __DIR__ . '/../../resources/views/pages/home.php';
    }
}