<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Leave Application Generator</title>
<style>
body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-color: #f5f6fa;
}

/* Container to hold form and preview side by side */
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

/* Form styling */
form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
    flex: 1 1 400px;
    min-width: 300px;
}

/* Preview styling */
#preview {
    background: #fff;
    padding: 20px;
    min-height: 400px;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
    white-space: pre-wrap;
    flex: 1 1 400px;
    min-width: 300px;
}

/* Common input styling */
label {
    font-weight: bold;
}
input, select, textarea, button {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 15px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 14px;
}
button {
    width: auto;
    margin-right: 5px;
    cursor: pointer;
}
</style>
</head>
<body>

<h2>Leave Application Generator</h2>

<div class="container">
    <form id="application_for_leave">
        <h3>Application for Leave</h3>

        <label>Name:</label>
        <input type="text" name="name_leave" required>

        <label>Class:</label>
        <input type="text" name="class_leave">

        <label>Stream:</label>
        <input type="text" name="stream_leave">

        <label>Roll Number:</label>
        <input type="text" name="roll_leave">

        <label>Reason:</label>
        <textarea name="reason_leave" rows="3" required></textarea>
        <button type="button" onclick="setReason('Sick Leave')">Sick Leave</button>
        <button type="button" onclick="setReason('Family Function')">Family Function</button>
        <button type="button" onclick="setReason('Personal Work')">Personal Work</button>
<br>
        <label>Choose Date Type:</label>
        <select id="date_type" onchange="showDateInput()">
            <option value="ad">AD</option>
            <option value="bs">BS</option>
        </select>

        <div id="date_inputs">
            <div id="ad_input">
                <label>Date (AD):</label>
                <input type="date" name="date_ad" id="date_ad" onchange="updatePreview()">
            </div>
            <div id="bs_input" style="display:none;">
                <label>Date (BS):</label>
                <input type="text" name="date_bs" id="date_bs" placeholder="YYYY-MM-DD" onchange="updatePreview()">
            </div>
        </div>

        <label>Receiver:</label>
        <input type="text" name="receiver_leave" placeholder="The Principal / Headteacher">

        <input type="submit" value="Generate Letter">
    </form>

    <div id="preview">Your letter preview will appear here...</div>
</div>

<script>
// Quick reason buttons
function setReason(reasonText) {
    document.querySelector('textarea[name="reason_leave"]').value = reasonText;
    updatePreview();
}

// Show AD/BS date input
function showDateInput(){
    var type = document.getElementById('date_type').value;
    document.getElementById('ad_input').style.display = type === 'ad' ? 'block' : 'none';
    document.getElementById('bs_input').style.display = type === 'bs' ? 'block' : 'none';
    updatePreview();
}

// Update live preview
function updatePreview(){
    var name = document.querySelector('input[name="name_leave"]').value || "[Your Name]";
    var cls = document.querySelector('input[name="class_leave"]').value || "[Your Class]";
    var stream = document.querySelector('input[name="stream_leave"]').value || "[Your Stream]";
    var roll = document.querySelector('input[name="roll_leave"]').value || "[Your Roll Number]";
    var reason = document.querySelector('textarea[name="reason_leave"]').value || "[Reason for leave]";
    var receiver = document.querySelector('input[name="receiver_leave"]').value || "The Principal / Headteacher";

    var dateType = document.getElementById('date_type').value;
    var date = dateType === 'ad' ? (document.getElementById('date_ad').value || new Date().toISOString().split('T')[0]) 
                                 : (document.getElementById('date_bs').value || "[BS Date]");

    let reasonSentence = "";
    let reasonLower = reason.toLowerCase();
    if (reasonLower.includes("sick") || reasonLower.includes("ill")) {
        reasonSentence = `I am feeling unwell and unable to attend school on ${date}.`;
    } else if (reasonLower.includes("family") || reasonLower.includes("function")) {
        reasonSentence = `Due to a family function, I will be unable to attend school on ${date}.`;
    } else if (reasonLower.includes("personal")) {
        reasonSentence = `I have some personal work and will be unable to attend school on ${date}.`;
    } else {
        reasonSentence = `I am unable to attend school on ${date} due to ${reason}.`;
    }

    document.getElementById('preview').innerHTML = 
`To,  
${receiver}  

Subject: Application for Leave  

Respected Sir/Madam,  

I am ${name}, a student of class ${cls}, stream ${stream}, Roll No. ${roll}.  
${reasonSentence}  

Kindly grant me leave for the mentioned date. I will make sure to complete any missed lessons.  

Thank you for your kind consideration.  

Yours sincerely,  
${name}  
Class: ${cls}  
Stream: ${stream}  
Roll No: ${roll}`;
}

// Update preview when input changes
document.querySelectorAll('#application_for_leave input, #application_for_leave textarea, #application_for_leave select')
.forEach(el => el.addEventListener('input', updatePreview));

// Initialize preview
updatePreview();
</script>

</body>
</html>
