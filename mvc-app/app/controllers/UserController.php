<?php

// for dealing with the view

class UserController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showRegisterForm() {
        $data = [
            'title' => "Register"
        ];

        render('user/register', $data);
    }

    public function register() {
        $user = new User();

        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if($user->store()) {
            redirect('/');
        } else {
            echo "Registration failed";
        }
    }

    public function updateProfile() {
        $userId = $_SESSION['user_id'];

        $firstName = sanitize($_POST['first_name'] ?? '');
        $lastName = sanitize($_POST['last_name'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $phone = sanitize($_POST['phone'] ?? '');
        $birthday = sanitize($_POST['birthday'] ?? '');
        $organization = sanitize($_POST['organization'] ?? '');
        $location = sanitize($_POST['location'] ?? '');

        $userData = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'birthday' => $birthday,
            'organization' => $organization,
            'location' => $location
        ];

        if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {

            $imagePath = $this->userModel->handleImageUpload($_FILES['profile_image']);

            if($imagePath) {
                $userData['profile_image'] = $imagePath;
            } else {
                setSessionMessage('error', 'FAILED to upload image');;
                redirect('/admin/users/profile');
            }
        }

        $updateStatus = $this->userModel->update($userId, $userData);

        if($updateStatus) {
            setSessionMessage('message', 'Profile updated successfully');

            // $_SESSION['message'] = "Profile updated successfully";
        } else {
            setSessionMessage('error', 'Failed to update profile');
        }

        redirect('/admin/users/profile');
    }

    public function updateUserProfilePassword() {
        var_dump($_POST);
    }

    public function showLoginForm() {
        $data = [
            'title' => 'Login'
        ];

        render('user/login', $data);
    }

    public function showProfile() {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);

        $data = [
            'title' => "Profile",
            'user' => $user,
        ];

        render('admin/users/profile', $data, 'layouts/admin_layout');
    }

    public function loginUser() {
        $this->userModel->email = $_POST['email'];
        $this->userModel->password = $_POST['password'];

        if($this->userModel->login()) {
            $_SESSION['username'] = $this->userModel->username;
            $_SESSION['user_id'] = $this->userModel->id; 
            $_SESSION['first_name'] = $this->userModel->first_name;
            $_SESSION['last_name'] = $this->userModel->last_name;
            redirect('/dashboard');
        } else {
            echo "There was an error";
        }

    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        redirect('/user/login');
    }
}