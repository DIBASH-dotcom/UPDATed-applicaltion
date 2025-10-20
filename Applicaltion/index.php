<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dependent Dropdown Letter Generator</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f5f6fa;
}
nav {
    background-color: #2c3e50;
    color: #fff;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
nav .logo {
    font-size: 20px;
    font-weight: bold;
}
nav ul {
    list-style: none;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}
nav ul li {
    margin-left: 20px;
}
nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    display: block;
}
nav ul li:hover {
    background-color: #34495e;
    border-radius: 5px;
}

.container {
    display: flex;
    gap: 20px;
    padding: 20px;
    flex: 1;
    flex-wrap: wrap;
}

/* Form and preview side-by-side */
.main-content {
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 10px;
    flex: 1 1 400px; /* grow, shrink, min-width */
    min-width: 300px;
}
#formArea {
    background: #fff;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 10px;
    flex: 1 1 400px;
    min-width: 300px;
    margin-top: 0;
    max-height: 600px; /* optional scroll */
    overflow-y: auto;
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}
input[type=submit] {
    background-color: #2c3e50;
    color: #fff;
    cursor: pointer;
    transition: 0.3s;
}
input[type=submit]:hover {
    background-color: #34495e;
}
footer {
    background-color: #2c3e50;
    color: #fff;
    text-align: center;
    padding: 15px;
    margin-top: auto;
}

/* ================= Mobile Responsive ================= */
@media (max-width: 768px) {
    nav {
        flex-direction: column;
        align-items: flex-start;
    }
    nav ul {
        flex-direction: column;
        width: 100%;
        margin-top: 10px;
    }
    nav ul li {
        margin-left: 0;
        margin-top: 5px;
    }
    .container {
        flex-direction: column;
    }
    input, textarea, select {
        font-size: 14px;
        padding: 8px;
    }
    .main-content, #formArea {
        flex: 1 1 100%;
        min-width: 100%;
        max-height: none;
    }
}
</style>

<script>
// Populate subcategories
function updateSubCategory() {
    const category = document.getElementById("category").value;
    const subCategory = document.getElementById("subCategory");
    subCategory.innerHTML = "<option value=''>-- Select Letter Type --</option>";

    const options = {
        school: [
            {name :"Application For Leave", file: "Applicaltion_Leave"},
            {name: "School Leaving Certificate", file: "school_leaving_certificate"},
            {name: "Fee Concession", file: "fee"},
            {name: "Change Subject", file: "change_sub"},
            {name: "Transfer Certificate", file: "transfer_certificate"}
        ],
        office: [
            {name:"Job Application Letter", file:"job_application"},
            {name:"Resignation Letter", file:"resignation_letter"},
            {name:"Leave Application for Office", file:"office_leave"},
            {name:"Request for Salary Increment", file:"salary_increment"}
        ],
        personal: [
            {name:"Letter to a Friend", file:"letter_to_friend"},
            {name:"Electricity Connection", file:"electricity_connection"},
            {name:"Request for Address Change", file:"address_change"},
            {name:"Complaint Letter", file:"complaint_letter"}
        ]
    };

    (options[category] || []).forEach(item => {
        const opt = document.createElement("option");
        opt.value = item.file;
        opt.text = item.name;
        subCategory.appendChild(opt);
    });
}

// Load selected letter template
function showForm() {
    const letterType = document.getElementById("subCategory").value;
    const formArea = document.getElementById("formArea");

    if (!letterType) {
        formArea.innerHTML = "<p>Please select a letter type to generate.</p>";
        return;
    }

    fetch("letters/" + letterType + ".php")
        .then(response => {
            if (!response.ok) throw new Error("Template not found");
            return response.text();
        })
        .then(html => {
            formArea.innerHTML = html;

            // Run scripts in loaded HTML
            formArea.querySelectorAll("script").forEach(oldScript => {
                const newScript = document.createElement("script");
                if (oldScript.src) newScript.src = oldScript.src;
                else newScript.textContent = oldScript.textContent;
                document.body.appendChild(newScript);
                document.body.removeChild(newScript);
            });
        })
        .catch(err => {
            console.error(err);
            formArea.innerHTML = "<p style='color:red;'>Error loading letter template.</p>";
        });
}
</script>
</head>
<body>

<nav>
    <div class="logo">Letter Generator</div>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
</nav>

<p style="padding:15px;">
    Please select a <strong>Category</strong> and then choose the <strong>Letter Type</strong>.
    Fill the form that appears and see the live preview on the right.
</p>

<div class="container">
    <div class="main-content">
        <h2>Letter Generator</h2>

        <label>Category:</label>
        <select id="category" onchange="updateSubCategory()">
            <option value="">-- Select Category --</option>
            <option value="school">School / College</option>
            <option value="office">Office / Job</option>
            <option value="personal">Personal / General</option>
        </select><br><br>

        <label>Letter Type:</label>
        <select id="subCategory" onchange="showForm()">
            <option value="">-- Select Letter Type --</option>
        </select><br><br>

        <!-- Loaded form will appear here -->
        <div id="formArea">
            <h3>Select a letter type to start generating.</h3>
        </div>
    </div>
</div>

<footer>
    &copy; Developed by Dibash Magar <?php echo date("Y"); ?>
</footer>

</body>
</html>
