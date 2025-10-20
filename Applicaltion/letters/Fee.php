<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fee Concession Letter Generator</title>
<style>
body { font-family: Arial, sans-serif; padding: 20px; background: #f5f6fa; }
.container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
form { background: #fff; padding: 20px; border-radius: 8px; flex: 1 1 400px; min-width: 300px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
form input, form textarea, form select, form button { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc; font-size: 14px; }
form button { width: auto; background: #007bff; color: #fff; border: none; cursor: pointer; }
form button:hover { background: #0056b3; }
#preview { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); white-space: pre-wrap; flex: 1 1 400px; min-width: 300px; }
h2 { text-align: center; width: 100%; }
</style>
</head>
<body>

<h2>Fee Concession Letter Generator</h2>

<div class="container">
    <form id="feeForm">
        <label>Your Name:</label>
        <input type="text" id="name" placeholder="e.g., Dibash Magar" required>

        <label>Your Address:</label>
        <input type="text" id="address" placeholder="e.g., Lazimpat">

        <label>City / State / ZIP:</label>
        <input type="text" id="city" placeholder="e.g., Kathmandu, Nepal">

        <label>Phone Number:</label>
        <input type="text" id="phone" placeholder="e.g., 980xxxxxxx">

        <label>Email Address:</label>
        <input type="text" id="email" placeholder="e.g., example@mail.com">

        <label>Calendar Type:</label>
        <select id="calendar" onchange="showDateInput()">
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
        </div>

        <label>Institution Name:</label>
        <input type="text" id="institution_name" placeholder="e.g., Sunshine High School">

        <label>Institution Address:</label>
        <input type="text" id="institution_address" placeholder="e.g., Kathmandu, Nepal">

        <label>Class / Program / Course:</label>
        <input type="text" id="student_class" placeholder="e.g., Class 12 / Science">

        <label>Reason for Fee Concession:</label>
        <textarea id="reason" rows="3" placeholder="Briefly state reason" required></textarea>
    </form>

    <div id="preview">Your fee concession letter preview will appear here...</div>
</div>

<script>
const fields = ['name','address','city','phone','email','institution_name','institution_address','student_class','reason'];
const inputs = {};
fields.forEach(f => inputs[f] = document.getElementById(f));
const calendarSelect = document.getElementById('calendar');
const dateAD = document.getElementById('date_ad');
const dateBS = document.getElementById('date_bs');
const adInputDiv = document.getElementById('ad_input');
const bsInputDiv = document.getElementById('bs_input');
const previewDiv = document.getElementById('preview');

function showDateInput() {
    const type = calendarSelect.value;
    adInputDiv.style.display = type === 'AD' ? 'block' : 'none';
    bsInputDiv.style.display = type === 'BS' ? 'block' : 'none';
    updatePreview();
}

function updatePreview() {
    const name = inputs['name'].value || "[Your Name]";
    const address = inputs['address'].value || "[Your Address]";
    const city = inputs['city'].value || "[City, State, ZIP]";
    const phone = inputs['phone'].value || "[Phone Number]";
    const email = inputs['email'].value || "[Email Address]";
    const institution_name = inputs['institution_name'].value || "[Institution Name]";
    const institution_address = inputs['institution_address'].value || "[Institution Address]";
    const student_class = inputs['student_class'].value || "[Class/Program/Course Name]";
    const reason = inputs['reason'].value || "[Reason]";
    const calendar = calendarSelect.value || "[AD/BS]";
    const date = calendar === 'AD' ? (dateAD.value || new Date().toISOString().split('T')[0])
                                   : (dateBS.value || "[BS Date]");

    previewDiv.innerText = `
${name}
${address}
${city}
${phone}
${email}

Date: ${date} (${calendar})

To
The Principal / Head of Institution
${institution_name}
${institution_address}

Subject: Request for Fee Concession

Respected Sir/Madam,

I, ${name}, a student of ${student_class} at your esteemed institution, am writing this letter to request a concession in the tuition/academic fees for the current academic year/session.

Due to ${reason}, it has become challenging for me to pay the full fees on time. I am sincerely committed to my studies and maintaining good academic performance.

I kindly request you to consider my situation and grant me a fee concession / reduction / scholarship, as it will greatly help me continue my education without interruption. I am willing to provide any necessary documents to support my request.

I would be extremely grateful for your kind consideration and support.

Thanking you,
Yours faithfully,

[Your Signature]
${name}
[Enrollment/Student ID if applicable]
    `;
}

// Attach input/change events
[...fields.map(f=>inputs[f]), calendarSelect, dateAD, dateBS].forEach(el => {
    el.addEventListener('input', updatePreview);
    el.addEventListener('change', updatePreview);
});

// Initialize preview
updatePreview();
</script>

</body>
</html>
