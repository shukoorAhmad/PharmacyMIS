@extends('layouts.master')
@section('content')
    <style>
        @media print {
            .navbar {
                display: none !important;
            }

            .sidebar {
                display: none !important;
            }

            body {
                background-color: #fff !important;
            }
        }

        ul>li {
            padding: .3rem;
        }
    </style>
    <div class="bg-white" style="padding: 5rem 6rem 0.5rem 6rem;">
        <div class="container">
            <h3 class="text-uppercase">Shukoor Ahmad Khamosh</h3>
        </div>
    </div>
    <div class="w-100 bg-white">
        <div class="w-100 d-flex align-items-center" style="background-color: #f5f6f5; height:2.5rem; color: #000; padding: 0 6rem;">
            <div class="container d-flex justify-content-start w-100">
                <div class="d-flex align-items-center">
                    <div style="background-color: #e0e0e0;width: 1.8rem;height: 1.8rem;text-align: center;border-radius: 1rem;font-size: 1rem;padding: 3px;">
                        <center class="zmdi zmdi-email"></center>
                    </div>
                    <strong class="pl-3 pr-3 font-weight-light">shukoorahmad.khamosh@gmail.com</strong>
                </div>
                <div class="d-flex align-items-center">
                    <div style="background-color: #e0e0e0;width: 1.8rem;height: 1.8rem;text-align: center;border-radius: 1rem;font-size: 1rem;padding: 3px;">
                        <center class="zmdi zmdi-phone"></center>
                    </div>
                    <strong class="pl-3 pr-3 font-weight-light">(+93) 795-814-021</strong>
                </div>
                <div class="d-flex align-items-center">
                    <div style="background-color: #e0e0e0;width: 1.8rem;height: 1.8rem;text-align: center;border-radius: 1rem;font-size: 1rem;padding: 3px;">
                        <center class="zmdi zmdi-pin"></center>
                    </div>
                    <strong class="pl-3 pr-3 font-weight-light">Kabul, Afghanistan</strong>
                </div>
            </div>
        </div>
        <p style="padding: 2rem 7rem; color: #000; text-align: justify;">Dear Hiring Manager,<br><br>
            I appreciate the chance to apply for the position of <b>IT Assistant</b> at your company. After reading your job description, it is obvious that you're searching for a candidate who is well-versed in the duties connected with the position and is capable of carrying them out with assurance. I am certain that I possess the skills necessary to successfully complete the job competently and perform above expectations in light of these requirements. <br><br>
            I am quality-driven and have a degree from <b>Isteqlal University (3.7 GPA, Bachelor of Computer Science)</b>. I was able to gain close to 5 years of job experience.I had the pleasure of working at <b>Swedish Committee for Afghanistan, Save The Children</b> as a <b>IT Assistant and IT Associate</b>, where I was able to learn and advance important professional skills which I metion above
        </p>
        <div style="display:flex; padding: 0 7rem; color: #000; justify-content:space-between;">
            <ul>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; Software Engineering</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; PHP (PL)</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; Microsoft Teams</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; Sharepoint</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; Database Designing & Developing</li>
            </ul>
            <ul>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; Data Management</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; MySQL</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; SQL Server</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; Postgresql</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; System Administration</li>
            </ul>
            <ul>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; MCITP, CCNA, CCNP</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; JavaScript</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; React JS</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; SPA Development</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; Power BI Dashboard</li>
            </ul>
            <ul>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; KOBO Questioner</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; System Integration</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; APIs</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; AJAX</li>
                <li><span class="zmdi zmdi-mail-send"></span>&nbsp; JSON</li>
            </ul>
        </div>
        <p style="padding: 2rem 7rem; color: #000; text-align: justify;">
            I have continuously received accolades from my instructors and peers for being results-oriented in both my academic and professional lives. I employ tested technical, teamwork, and leadership skills while working on academic, extracurricular, or professional projects. I aim to use these abilities in the <b>IT Assistant</b> position at your company. <br><br>
            I hope you would accept after reading my resume that I am the kind of qualified and competitive applicant you are searching for. I look forward to going into more detail about how my unique skills and abilities will help your company. To schedule a comfortable meeting time, please call (+93) 795-814-021 or send me an email at shukoorahmad.khamosh@gmail.com. <br><br>
            Thank you for your consideration, and I look forward to hearing from you soon. <br> <br>
            Sincerely, Shukoor Ahmad Khamosh
        </p>
    </div>
@endsection
