<?php
// hash.php
// Cara pakai: jalankan di browser: http://localhost/aplikasi/hash.php
// Atau jalankan via CLI: php hash.php

//$password = 'admin123'; // Ganti dengan password yang ingin di-hash

// echo '<h3>Generate Password Hash</h3>';
// echo 'Password plain: <b>' . htmlspecialchars($password) . '</b><br>';
// echo 'Password hash:  <b>' . password_hash($password, PASSWORD_DEFAULT) . '</b><br>';

// hash_user.php
$password = 'Karawang123'; // password user yang ingin di-hash

echo '<h3>Generate Password Hash</h3>';
echo 'Password plain: <b>' . htmlspecialchars($password) . '</b><br>';
echo 'Password hash:  <b>' . password_hash($password, PASSWORD_DEFAULT) . '</b><br>';



// INSERT INTO `users` (`username`, `password`, `role`) VALUES
// ('admin','$2y$10$nSJC/sgEE1IY/5LGwris0eP2I9IbxR6UCBzbMGyFLnZ2a.lxCDBhG','admin');

