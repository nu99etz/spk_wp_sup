<?php

$config = array();

// Config URL
$config['base_url'] = "http://localhost:8080";
$config['root'] = '/var/www/html';
$config['path'] = '/spk_wp_sup';
$config['assets'] = $config['path'] . '/assets/';
$config['helpers'] = '../helpers/';
$config['models'] = '../models/';
// $config['upload'] = '../upload/';
$config['upload'] = '../upload/';
$config['include'] = $config['path'] . '/include/';
$config['vendor'] = '../vendor/';

// Config DB
$config['db_host'] = "mariadb-server";
$config['db_name'] = "spk_wp_sup";
$config['db_username'] = "root";
$config['db_password'] = "sapi";

// Config Tampilan

// Main Navbar ("dark" = Gelap, "light" = Terang)
$config['main-color'] = "dark";

// Secondary Navbar ("primary" = Biru, "success" = Hijau, "danger" = Merah, "warning" = Kuning, "secondary" = Abu-abu, "dark" = HItam Gelap)
$config['second-color'] = "red";

// Nama Aplikasi
$config['tenants-name'] = "SPK WP SUP";

// Config Mengaktifkan Mode Import (true = 'aktif', false = 'tidak aktif')
$config['import_mode'] = true;