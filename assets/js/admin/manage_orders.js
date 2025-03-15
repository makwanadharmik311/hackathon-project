function updateOrderStatus(orderId, newStatus) {
    if (confirm("Are you sure you want to change the order status?")) {
        fetch("/admin/update_order_status.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `order_id=${orderId}&status=${newStatus}`
        })
        .then(response => response.text())
        .then(data => alert(data));
    }
}

function deleteOrder(orderId) {
    if (confirm("Are you sure you want to delete this order?")) {
        fetch("/admin/delete_order.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `order_id=${orderId}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
}
