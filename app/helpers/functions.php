<?php

session_start();

function sanitizeData($data)
{
    foreach ($data as $key => $value) {
        $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $data;
}


function isLogIn()
{
    if (isset($_SESSION['role_id'])) {
        return true;
    } else {
        return false;
    }
}

function isAdmin()
{
    if (!isLogIn() && !$_SESSION['role_id'] == 1) {
        header('location:' . URLROOT . '/home');
        exit();
    }
}


function formatDate($data)
{
    $date = new DateTime($data);
    $formatted = $date->format('h:i A, F d, Y');
    return $formatted;
}
// h:i:s A F d, Y

function pagination($totalpages)
{

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = max(1, min($_GET['page'], $totalpages));
    } else {
        $currentPage = 1;
    }
    return $currentPage;
}

function get_select($key, $value)
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST[$key]) && $_POST[$key] == $value) {
            return "selected";
        }
    }

    return "";
}


function flash($name = '', $message = '', $class = 'alert alert-success')
{
    // Set flash message
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        }
    }
}

function displayFlashMessage($name)
{
    // Display flash message
    if (!empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
        echo '<div class="' . $class . '">' . $_SESSION[$name] . '</div>';
        unset($_SESSION[$name]); // Unset the session variable after displaying
        unset($_SESSION[$name . '_class']);
    }
}
