<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata - {{ $name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #e8e8e8;
            padding: 20px;
            min-height: 100vh;
        }

        .biodata-container {
            max-width: 700px;
            margin: 0 auto;
            background: linear-gradient(135deg, #5f9ea0 0%, #6ba8aa 100%);
            border-radius: 0;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header-section {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #5f9ea0 0%, #6ba8aa 100%);
        }

        .photo-container {
            background: white;
           
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
        }

        .profile-photo {
            width: 100%;
            height: 350px;
            background: linear-gradient(135deg, #d4a5a5 0%, #c89595 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: white;
        }

        .header-info {
            color: white;
            padding: 10px 0;
        }

        .header-info h1 {
            font-size: 30px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .header-info-item {
            margin-bottom: 8px;
            font-size: 12px;
            line-height: 1.6;
        }

        .header-info-item strong {
            display: inline-block;
            min-width: 180px;
        }

        .content {
            background: #d9e8e8;
            padding: 0;
        }

        .section {
            margin: 0;
            padding: 20px;
            background: #d9e8e8;
            border-bottom: 1px solid #b8d4d4;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 20px;
            color: #2c5f5f;
            margin-bottom: 15px;
            font-weight: bold;
            padding-bottom: 8px;
            border-bottom: 2px solid #5f9ea0;
        }

        .section-content {
            color: #333;
            font-size: 14px;
            line-height: 1.8;
        }

        .info-item {
            margin-bottom: 6px;
            color: #2c2c2c;
        }

        .info-item strong {
            color: #1a1a1a;
            display: inline-block;
            min-width: 180px;
        }

        .about-text {
            color: #2c2c2c;
            line-height: 1.8;
            text-align: justify;
        }

        .age-translation {
            color: #2c5f5f;
            font-style: italic;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .header-section {
                grid-template-columns: 1fr;
            }
            
            .header-info h1 {
                font-size: 28px;
            }
            
            .profile-photo {
                height: 250px;
            }
        }

        .footer {
            background: #5f9ea0;
            padding: 15px;
            text-align: center;
            color: white;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="biodata-container">
       <div class="header-section">
            <div class="photo-container">
                <div class="profile-photo">
                    <img src="{{ asset($photoPath) }}" alt="{{ $name }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
            
            <div class="header-info">
                <h1>{{ $name }}</h1>
                
                <div class="header-info-item">
                    <strong>Age:</strong> {{ $age }}
                    @if($ageTranslation)
                        <span class="age-translation">({{ $ageTranslation }})</span>
                    @endif
                </div>
                <div class="header-info-item">
                    <strong>Date and time of birth:</strong> {{ $dateOfBirth }}
                </div>
                <div class="header-info-item">
                    <strong>Place of birth:</strong> {{ $birthPlace }}
                </div>
                <div class="header-info-item">
                    <strong>Place of residence:</strong> {{ $address }}
                </div>
                <div class="header-info-item">
                    <strong>Nationality:</strong> {{ $nationality }}
                </div>
                <div class="header-info-item">
                    <strong>Religion:</strong> {{ $religion }}
                </div>
                <div class="header-info-item">
                    <strong>Caste:</strong> {{ $civilStatus }}
                </div>
                <div class="header-info-item">
                    <strong>Height:</strong> {{ $height }}
                </div>
                <div class="header-info-item">
                    <strong>Weight:</strong> {{ $weight }}
                </div>
                <div class="header-info-item">
                    <strong>Education:</strong> {{ $college }}
                </div>
            
                <div class="header-info-item">
                    <strong>Languages:</strong> {{ $languages }}
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content">
            <!-- About Me -->
            <div class="section">
                <div class="section-title">About Me</div>
                <div class="section-content">
                    <p class="about-text">
                       I am a responsible and hardworking student who is passionate about learning new things, especially in web development and programming. I enjoy improving my skills and taking on challenges that help me grow both personally and academically. I am determined, adaptable, and always willing to learn from my experiences.
                    </p>
                </div>
            </div>

            <!-- Family Background -->
            <div class="section">
                <div class="section-title">Family Background</div>
                <div class="section-content">
                    <div class="info-item">
                        <strong>Father's Name:</strong> {{ $fatherName }}
                    </div>
                    <div class="info-item">
                        <strong>Father's Profession:</strong> {{ $fatherOccupation }}
                    </div>
                    <div class="info-item">
                        <strong>Mother's Name:</strong> {{ $motherName }}
                    </div>
                    <div class="info-item">
                        <strong>Mother's Profession:</strong> {{ $motherOccupation }}
                    </div>
                    <div class="info-item">
                        <strong>No. of Sisters:</strong> 0
                    </div>
                    <div class="info-item">
                        <strong>Family Type:</strong> Nuclear
                    </div>
                    <div class="info-item">
                        <strong>Social Class:</strong> Middle Class
                    </div>
                    <div class="info-item">
                        <strong>Place of Residence:</strong> {{ $address }}
                    </div>
                </div>
            </div>

            <!-- Educational Background -->
            <div class="section">
                <div class="section-title">Educational Background</div>
                <div class="section-content">
                    <div class="info-item">
                        <strong>Elementary:</strong> {{ $elementary }}
                    </div>
                    <div class="info-item">
                        <strong>High School:</strong> {{ $highSchool }}
                    </div>
                    <div class="info-item">
                        <strong>College:</strong> {{ $college }}
                    </div>
                </div>
            </div>

            <!-- Expectations -->
            <div class="section">
                <div class="section-title">Expectations</div>
                <div class="section-content">
                    <p class="about-text">
                        I am at the stage of my career and life where I have reached satisfactory experience and self-sufficiency. 
                        I am looking for a professionally stable and financially independent life partner who knows their worth yet 
                        remains respectful of others. As someone who values {{ $hobbies }}, I would like my partner to be physically 
                        fit and willing to spend quality time together building a future based on mutual respect and understanding.
                    </p>
                </div>
            </div>

            <!-- Contact Details -->
            <div class="section">
                <div class="section-title">Contact Details</div>
                <div class="section-content">
                    <div class="info-item">
                        <strong>Phone Number:</strong> {{ $contactNumber }}
                    </div>
                    <div class="info-item">
                        <strong>Residence Address:</strong> {{ $address }}
                    </div>
                    <div class="info-item">
                        <strong>Email Address:</strong> {{ $email }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>