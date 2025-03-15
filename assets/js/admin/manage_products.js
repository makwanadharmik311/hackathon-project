function updateCertification(productId, newStatus) {
    fetch("../products/update_product.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `product_id=${productId}&certification_status=${newStatus}`
    })
    .then(response => response.text())
    .then(data => alert(data));
}

function editProduct(productId) {
    window.location.href = `edit_product.php?id=${productId}`;
}

function deleteProduct(productId) {
    if (confirm("Are you sure you want to delete this product?")) {
        fetch("../products/delete_product.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `product_id=${productId}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
}
