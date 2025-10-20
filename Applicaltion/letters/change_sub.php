<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dynamic Letter Generator</title>
<style>
body { font-family: Arial, sans-serif; padding: 20px; background: #f5f6fa; }
.container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
form { background: #fff; padding: 20px; border-radius: 8px; flex: 1 1 400px; min-width: 300px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
form input, form textarea, form select { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc; font-size: 14px; }
#preview { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1); white-space: pre-wrap; flex: 1 1 400px; min-width: 300px; }
button { padding: 10px 15px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
button:hover { background: #0056b3; }
</style>
</head>
<body>

<h2>Dynamic Letter Generator</h2>

<div class="container">
<form id="letterForm">
    <label>Your Name:</label>
    <input type="text" id="name" placeholder="e.g., Dibash Magar" required>

    <label>Your Address:</label>
    <input type="text" id="address">

    <label>City / State / ZIP:</label>
    <input type="text" id="city">

    <label>Phone Number:</label>
    <input type="text" id="phone">

    <label>Email Address:</label>
    <input type="text" id="email">

    <label>Student ID / Roll Number:</label>
    <input type="text" id="roll" placeholder="e.g., 12345" required>

    <label>Select Board/University:</label>
    <select id="board" required>
        <option value="">--Select Board/University--</option>
        <option value="NEB">NEB</option>
        <option value="CTEVT">CTEVT</option>
        <option value="TU">TU</option>
        <option value="PU">PU</option>
        <option value="KU">KU</option>
        <option value="Other">Other</option>
    </select>

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
    <input type="text" id="institution_name">

    <label>Institution Address:</label>
    <input type="text" id="institution_address">

    <label>Level / Program:</label>
    <select id="student_class" onchange="showYearSemester()">
        <option value="">--Select Level--</option>
        <option value="School / Grade">School / Grade</option>
        <option value="+2 / Higher Secondary">+2 / Higher Secondary</option>
        <option value="Diploma Program">Diploma Program</option>
        <option value="Bachelor's Program">Bachelor's Program</option>
        <option value="Master's Program">Master's Program</option>
    </select>

    <div id="year_semester_div" style="display:none;">
        <label>Year / Semester:</label>
        <input type="text" id="year_semester" placeholder="e.g., 1st Year / Semester 2">
    </div>

    <label>Subject:</label>
    <input type="text" id="subject" placeholder="Enter subject of the letter" required>

    <label>Reason / Details:</label>
    <textarea id="reason" rows="3" placeholder="Briefly state reason" required></textarea>

    <button type="button" onclick="downloadLetter()">Download Letter</button>
</form>

<div id="preview">Your letter preview will appear here...</div>
</div>

<script>
const fields = ['name','address','city','phone','roll','board','institution_name','institution_address','student_class','reason','year_semester','subject'];
const inputs = {};
fields.forEach(f => inputs[f] = document.getElementById(f));

const calendarSelect = document.getElementById('calendar');
const dateAD = document.getElementById('date_ad');
const dateBS = document.getElementById('date_bs');
const adInputDiv = document.getElementById('ad_input');
const bsInputDiv = document.getElementById('bs_input');
const yearSemesterDiv = document.getElementById('year_semester_div');
const previewDiv = document.getElementById('preview');

function showDateInput() {
    const type = calendarSelect.value;
    adInputDiv.style.display = type === 'AD' ? 'block' : 'none';
    bsInputDiv.style.display = type === 'BS' ? 'block' : 'none';
    updatePreview();
}

function showYearSemester() {
    const val = inputs['student_class'].value;
    yearSemesterDiv.style.display = (val.includes("Bachelor") || val.includes("Master")) ? 'block' : 'none';
    updatePreview();
}

function updatePreview() {
    const name = inputs['name'].value || "[Your Name]";
    const address = inputs['address'].value || "[Your Address]";
    const city = inputs['city'].value || "[City, State, ZIP]";
    const phone = inputs['phone'].value || "[Phone Number]";
    const roll = inputs['roll'].value || "[Student ID / Roll Number]";
    const board = inputs['board'].value || "[Board/University]";
    const institution_name = inputs['institution_name'].value || "[Institution Name]";
    const institution_address = inputs['institution_address'].value || "[Institution Address]";
    const student_class = inputs['student_class'].value || "[Class/Program/Degree Name]";
    const reason = inputs['reason'].value || "[Reason]";
    const year_sem = inputs['year_semester'].value || "";
    const calendar = calendarSelect.value || "[AD/BS]";
    const date = calendar === 'AD' ? (dateAD.value || new Date().toISOString().split('T')[0])
                                   : (dateBS.value || "[BS Date]");
    const subject = inputs['subject'].value || "[Subject]";

    previewDiv.innerText = `
${name}
${address}
${city}
${phone}
Student ID / Roll Number: ${roll}

Date: ${date} (${calendar})

To
The Principal / Head of Institution
${institution_name}
${institution_address}

Subject: ${subject}

Respected Sir/Madam,

I, ${name}, a student of ${student_class} ${year_sem ? "- " + year_sem : ""} under ${board}, bearing Student ID / Roll Number ${roll}, am writing regarding ${subject.toLowerCase()}.

Due to ${reason}, I am unable to complete/fulfill the requirements at this time. I sincerely request your kind consideration to support me as needed.

I assure you that I will continue to maintain good academic performance and adhere to all rules of the institution. Your support in this matter will be highly appreciated.

Thank you for your kind consideration.

Yours sincerely,
${name}
Student ID / Roll Number: ${roll}
    `;
}

// Attach input/change events
[...fields.map(f=>inputs[f]), calendarSelect, dateAD, dateBS].forEach(el => {
    el.addEventListener('input', updatePreview);
    el.addEventListener('change', updatePreview);
});

updatePreview();

// Optional: Download as .txt
function downloadLetter() {
    const text = previewDiv.innerText;
    const blob = new Blob([text], { type: "text/plain" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "letter.txt";
    link.click();
}
</script>

</body>
</html>
