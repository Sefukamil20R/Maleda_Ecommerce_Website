// script.js

function showForm(action) {
    const formContainer = document.getElementById('form-container');
    let formHtml = '';

    if (action === 'add') {
        formHtml = `
            <form action="admin_actions.php" method="post">
                <input type="hidden" name="action" value="add">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required><br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required><br>
                <label for="image">Image URL:</label>
                <input type="text" id="image" name="image" required><br>
                <input type="submit" value="Add Product">
            </form>
        `;
    } else if (action === 'edit') {
        formHtml = `
        <form action="admin_actions.php" method="post">
            <input type="hidden" name="action" value="edit">
            <label for="id">Product ID:</label>
            <input type="number" id="id" name="id" required><br>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title"><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" ><br>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity"><br>
            <label for="image">Image URL:</label>
            <input type="text" id="image" name="image"><br>
            <input type="submit" value="Edit Product">
        </form>
    `;
        // Similar code for edit form
    } else if (action === 'remove') {
        formHtml = `
                <form action="admin_actions.php" method="post">
                    <input type="hidden" name="action" value="remove">
                    <label for="id">Product ID:</label>
                    <input type="number" id="id" name="id" required><br>
                    <input type="submit" value="Remove Product">
                </form>
            `;
    }

    formContainer.innerHTML = formHtml;
    document.getElementById('form-modal').style.display = 'block';
}

function closeForm() {
    document.getElementById('form-modal').style.display = 'none';
}
