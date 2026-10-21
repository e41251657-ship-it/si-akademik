
<?php

class BaseController
{
    // Menampilkan file dari folder Views
    protected function view($view, $data = [])
    {
        $file = __DIR__ . '/../Views/' . $view . '.php';

        if (file_exists($file)) {
            extract($data);
            require $file;
        } else {
            echo "Halaman tidak ditemukan: " . $view;
        }
    }

    // Mengarahkan pengguna ke halaman lain
    protected function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
}
