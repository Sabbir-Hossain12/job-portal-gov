
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admit Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        .admit-card {
            border: 1px solid #000;
            padding: 20px;
            width: 800px;
            margin: auto;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header img {
            height: 60px;
            vertical-align: middle;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
        .info-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 5px;
            vertical-align: top;
        }
        .photo {
            width: 120px;
            text-align: center;
        }
        .photo img {
            width: 100px;
            height: auto;
            border: 1px solid #000;
        }
        .signature {
            margin-top: 20px;
        }
        .instructions {
            margin-top: 30px;
        }
        .footer {
            margin-top: 40px;
            border-top: 1px solid #000;
            padding-top: 10px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
        }

        @media print {
            body {
                margin: 0;
            }
            .admit-card {
                border: none;
                padding: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="admit-card">
    <div class="header">
        <img src="https://i.ibb.co/kDf38Yv/bd-logo.png" alt="BD Logo" />
        <h2>Government of the People's Republic of Bangladesh<br>Payra Port Authority</h2>
        <div class="title">Admit Card for the post of ‘Assistant Director (Accounts)’</div>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Roll No:</strong></td>
            <td>1200015</td>
            <td class="photo" rowspan="6"><img src="https://i.ibb.co/f9CH2GZ/profile-placeholder.png" alt="Photo"></td>
        </tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td>MD. FARIDUL HASAN</td>
        </tr>
        <tr>
            <td><strong>Mother’s Name:</strong></td>
            <td>FATEMA BEGUM</td>
        </tr>
        <tr>
            <td><strong>Father’s Name:</strong></td>
            <td>ABDUL SATTAR</td>
        </tr>
        <tr>
            <td><strong>Exam Date and Time:</strong></td>
            <td>Friday, April 22, 2022 (10:00 a.m. to 11:00 a.m.)</td>
        </tr>
        <tr>
            <td><strong>Exam Center:</strong></td>
            <td>Sidheswari Girls’ High School, 30, New Baily Road, Ramna, Dhaka 1217</td>
        </tr>
    </table>

    <div class="signature">
        <p><strong>Candidate's Signature:</strong> ______________________</p>
    </div>

    <div class="instructions">
        <h4>Instructions to the Candidates</h4>
        <ol>
            <li>This admit card will be applicable for written examination, practical examination and viva voce.</li>
            <li>Bringing Mobile Phone or Calculator or any electronic device including electronic/digital watch is STRICTLY PROHIBITED.</li>
            <li>Candidates should bring Black Ballpoint pen for examination.</li>
            <li>Candidates must reach the examination hall 30 minutes before the commencement of the examination.</li>
            <li>Photograph on this admit card will be verified with the application form.</li>
            <li>Applicant must use the same signature used in the application.</li>
            <li>Misbehavior or unfair means will lead to punishment or disqualification.</li>
            <li>No TA/DA will be provided for attending the exam.</li>
            <li>Candidates must follow the health instructions.</li>
        </ol>
    </div>

    <div class="footer">
        <div>
            Downloading Date: 22-04-18 12:11:04<br>
            User ID: MPG03ZUQ | System ID: 2B6xA8DPa1B2zB6B93BBOE4502B6c6CB
        </div>
        <div style="text-align: right;">
            <strong>Commander M Rafiul Hasain (TAS) psc, BN (Retd.)</strong><br>
            Member (Admin and Finance)<br>
            Payra Port Authority
        </div>
    </div>
</div>

<script>
    // Auto print when loaded (optional)
    window.onload = () => window.print();
</script>
</body>
</html>
