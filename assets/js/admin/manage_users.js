function updateRole(userId, newRole) {
    if (confirm("Are you sure you want to change this user's role?")) {
        fetch("/users/update_role.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `user_id=${userId}&new_role=${newRole}`
        })
        .then(response => response.text())
        .then(data => alert(data));
    }
}

function deleteUser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        fetch("/users/delete_user.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `user_id=${userId}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
}



