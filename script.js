const API_READ = "api.php";
const API_CREATE = "create.php";
const API_UPDATE = "update.php";
const API_DELETE = "delete.php";

function loadProducts() {
    fetch(API_READ)
    .then(res => res.json())
    .then(data => {
        let rows = "";

        data.forEach(p => {
            rows += `
            <tr>
                <td>${p.product_id}</td>
                <td>${p.product_name}</td>
                <td>₱${p.price}</td>
                <td>${p.description}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editProduct(${p.product_id}, '${p.product_name}', '${p.price}', \`${p.description}\`)">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteProduct(${p.product_id})">Delete</button>
                </td>
            </tr>
            `;
        });

        document.getElementById("productTable").innerHTML = rows;
    });
}
function createProduct() {
    const product = {
        product_name: document.getElementById("product_name").value,
        price: document.getElementById("price").value,
        description: document.getElementById("description").value
    };

    fetch(API_CREATE, {
        method: "POST",
        body: JSON.stringify(product)
    })
    .then(() => {
        loadProducts();
        clearForm();
    });
}

function updateProduct() {
    const product = {
        product_id: document.getElementById("product_id").value,
        product_name: document.getElementById("product_name").value,
        price: document.getElementById("price").value,
        description: document.getElementById("description").value
    };

    fetch(API_UPDATE, {
        method: "POST",
        body: JSON.stringify(product)
    })
    .then(() => {
        loadProducts();
        clearForm();
    });
}

function deleteProduct(id) {
    fetch(API_DELETE, {
        method: "POST",
        body: JSON.stringify({ product_id: id })
    })
    .then(() => loadProducts());
}

function editProduct(id, name, price, description) {
    document.getElementById("product_id").value = id;
    document.getElementById("product_name").value = name;
    document.getElementById("price").value = price;
    document.getElementById("description").value = description;

    document.getElementById("createBtn").classList.add("d-none");
    document.getElementById("updateBtn").classList.remove("d-none");
}


function clearForm() {
    document.querySelectorAll("input, textarea").forEach(el => el.value = "");
    document.getElementById("createBtn").classList.remove("d-none");
    document.getElementById("updateBtn").classList.add("d-none");
}

loadProducts();