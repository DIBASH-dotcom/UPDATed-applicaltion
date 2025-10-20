<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>School Leaving Certificate Generator</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    padding: 20px;
}
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}
form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    flex: 1 1 400px;
    min-width: 300px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
}
form input, form select, form button {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 15px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 14px;
}
form button {
    width: auto;
    background: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}
form button:hover {
    background: #0056b3;
}
#preview {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
    white-space: pre-wrap;
    flex: 1 1 400px;
    min-width: 300px;
}
h2 {
    text-align: center;
    width: 100%;
}
</style>
</head>
<body>

<h2>School Leaving Certificate Generator</h2>

<div class="container">
    <form id="certificateForm">
        <label>Full Name:</label>
        <input type="text" id="name" placeholder="e.g., Dibash Magar" required>

        <label>Class / Program:</label>
        <input type="text" id="class" placeholder="e.g., Class 12" required>

        <label>Roll Number:</label>
        <input type="text" id="roll" required>

        <label>Registration Number:</label>
        <input type="text" id="reg" required>

        <label>Contact Number:</label>
        <input type="text" id="contact">

        <label>Reason for Leaving:</label>
        <select id="reason" required>
            <option value="">--Select Reason--</option>
            <option value="completed studies">Completed Studies</option>
            <option value="transferring to another institution">Transferring to Another Institution</option>
            <option value="personal reasons">Personal Reasons</option>
        </select>

        <label>Calendar Type:</label>
        <select id="calendar" onchange="showDateInput()" required>
            <option value="AD">AD</option>
            <option value="BS">BS</option>
        </select>

        <div id="date_inputs">
            <div id="ad_input">
                <label>Date (AD):</label>
                <input type="date" id="date_ad" onchange="updatePreview()">
            </div>
            <div id="bs_input" style="display:none;">
                <label>Date (BS):</label>
                <input type="text" id="date_bs" placeholder="YYYY-MM-DD" onchange="updatePreview()">
            </div>
            <!-- Add inside the form -->
<label>School Name:</label>
<input type="text" id="school_name" placeholder="e.g., Ramawapur Secondary School">

<label>School Address:</label>
<input type="text" id="school_address" placeholder="e.g., Butwal, Nepal">

        </div>
        
    </form>

    <div id="preview">Your leaving certificate preview will appear here...</div>
</div>

<script>
const nameInput = document.getElementById('name');
const classInput = document.getElementById('class');
const rollInput = document.getElementById('roll');
const regInput = document.getElementById('reg');
const contactInput = document.getElementById('contact');
const reasonSelect = document.getElementById('reason');
const calendarSelect = document.getElementById('calendar');
const dateAD = document.getElementById('date_ad');
const dateBS = document.getElementById('date_bs');
const adInputDiv = document.getElementById('ad_input');
const bsInputDiv = document.getElementById('bs_input');
const schoolNameInput = document.getElementById('school_name');
const schoolAddressInput = document.getElementById('school_address');
const previewDiv = document.getElementById('preview');

// Show AD/BS input
function showDateInput() {
    const type = calendarSelect.value;
    adInputDiv.style.display = type === 'AD' ? 'block' : 'none';
    bsInputDiv.style.display = type === 'BS' ? 'block' : 'none';
    updatePreview();
}

// Update preview
function updatePreview() {
    const name = nameInput.value || "[Full Name]";
    const cls = classInput.value || "[Class/Program]";
    const roll = rollInput.value || "[Roll No]";
    const reg = regInput.value || "[Reg No]";
    const contact = contactInput.value || "[Contact No]";
    const reason = reasonSelect.value || "[Reason]";
    const calendar = calendarSelect.value || "[AD/BS]";
    const date = calendar === 'AD' ? (dateAD.value || new Date().toISOString().split('T')[0])
                                   : (dateBS.value || "[BS Date]");

           const schoolName = schoolNameInput.value || "[School Name]";
    const schoolAddress = schoolAddressInput.value || "[School Address]";                       
    previewDiv.innerText = `
School Leaving Certificate

This is to certify that ${name}, a student of ${cls}, bearing Roll No. ${roll} and Registration No. ${reg}, has been a student of our institution.

The above-named student is leaving the school due to ${reason}. During their tenure, they have exhibited satisfactory conduct and performance.

We hereby issue this Leaving Certificate on ${date} (${calendar}) for all official purposes.

Contact Number: ${contact}

Principal / Headteacher
${schoolName}
${schoolAddress}
    `;
}

// Attach input/change listeners
[nameInput, classInput, rollInput, regInput, contactInput, reasonSelect, calendarSelect, dateAD, dateBS , schoolNameInput, schoolAddressInput ].forEach(el => {
    el.addEventListener('input', updatePreview);
    el.addEventListener('change', updatePreview);
});

// Initialize preview
updatePreview();
</script>

</body>
</html>
