<?php

class HomeController
{
    public function index()
    {
        echo "<h1>Halaman Home</h1>";
    }
public function dashboard()
{
    echo "<h1>Dashboard</h1>";
    echo "<p>Halo, " . $_SESSION['username'] . "</p>";
    echo "<a href='/akademik14/public/logout'>Logout</a>";
}

}