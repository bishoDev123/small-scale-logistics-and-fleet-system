<?php
require_once "models/Part.php";

class PartController {
    // عرض كل القطع
    public function index() {
        $parts = Part::getAll();
        require "views/parts/index.php";
    }

    // صفحة الإضافة ومعالجة البيانات
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Part::create($_POST['name'], $_POST['max_life'], $_POST['current_usage']);
            header("Location: index.php?url=part/index");
            exit;
        }
        require "views/parts/create.php";
    }

    // صفحة التعديل ومعالجة البيانات
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Part::update($_POST['id'], $_POST['name'], $_POST['max_life'], $_POST['current_usage']);
            header("Location: index.php?url=part/index");
            exit;
        }
        $id = $_GET['id'];
        $part = Part::getById($id);
        require "views/parts/edit.php";
    }

    // معالجة الحذف
    public function delete() {
        if (isset($_GET['id'])) {
            Part::delete($_GET['id']);
        }
        header("Location: index.php?url=part/index");
        exit;
    }
}