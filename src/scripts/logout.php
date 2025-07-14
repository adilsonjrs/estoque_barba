<?php
include_once '../db/security.php';
session_start();
session_destroy();
secureRedirect('../../login.php');