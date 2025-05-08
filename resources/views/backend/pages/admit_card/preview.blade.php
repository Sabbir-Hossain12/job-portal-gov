
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
            background-color: green;
        }
        .header img {
            height: 60px;
            vertical-align: middle;
            margin-top: 10px;
        }

        .header .title
        {
            color: #e2d7d7;
        }
        
        .header h2
         {
            color: #e2d7d7;
            font-size: 20px;
         }
        .title {
            font-size: 16px;
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
        .signature img {
            width: 150px;
            height: auto;
            /*border: 1px solid #000;*/
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
        @if(isset($basicInfo->dark_logo))
        <img src="{{ asset($basicInfo->dark_logo) }}" alt="BD Logo" />
        @endif
        <h2>{{ $basicInfo->site_name ?? "Government of the People's Republic of Bangladesh" }}<br>{{ $basicInfo->department_name ?? 'Department of Livestock Services - DLS' }}</h2>
        <div class="title">Admit Card for the post of ‘{{ $jobApplications->position->title ?? '' }}’</div>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Roll No:</strong></td>
            <td>{{ $jobApplications->admitCard->role_number ?? '' }}</td>
            <td class="photo" rowspan="6"><img src="{{ asset($jobApplications->img) }}" alt="Photo"></td>
        </tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td>{{ $jobApplications->candidate_name ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Mother’s Name:</strong></td>
            <td>{{ $jobApplications->mothers_name ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Father’s Name:</strong></td>
            <td>{{ $jobApplications->fathers_name ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Exam Date and Time:</strong></td>
            <td>{{ \Carbon\Carbon::parse($jobApplications->jobPost->exam_date)->format('d M, Y') }} ({{ $jobApplications->jobPost->exam_time ?? ''  }})</td>
        </tr>
        <tr>
            <td><strong>Exam Center:</strong></td>
            <td>{{ $jobApplications->position->exam_center ?? '' }}</td>
        </tr>
    </table>

    <div class="signature">
        <p><img src="{{ asset($jobApplications->signature) }}" alt="Signature"></p>
        <p>
            <strong>Candidate's Signature:</strong>
        </p>
    </div>

    <div class="instructions">
        <h4>Instructions to the Candidates</h4>
        
       {!!  $jobApplications->jobPost->exam_instructions ?? '' !!}
        
    </div>

    <div class="footer">
        <div>
            Downloading Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}<br>
            User ID: {{ $jobApplications->admitCard->candidateID ?? '' }} | System ID: {{ $jobApplications->admitCard->systemID ?? '' }}
        </div>
        
        <div style="text-align: right;">
            <img src="" alt="">
            <strong>{{ $basicInfo->signatory_name ?? '' }}</strong>
            <br>
            {{ $basicInfo->signatory_designation ?? '' }}
            <br>
            {{ $basicInfo->signatory_organization ?? '' }}
        </div>
    </div>
</div>

<script>
    // Auto print when loaded (optional)
    // window.onload = () => window.print();
</script>
</body>
</html>
