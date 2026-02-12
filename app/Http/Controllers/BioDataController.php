<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    // User information variables
    private $name = "Gellie Anne T. Costales";
    private $age = 23;
    private $gender = "female"; // Change to "male" for male layout
    private $dateOfBirth = "07/21/2002";
    private $birthPlace = "Umingan, Pangasinan";
    private $nationality = "Filipino";
    private $civilStatus = "Single"; // Using this for Caste field
    private $religion = "Jehovah's Witness";
    private $height = "5' 2\"";
    private $weight = "49 kg";
    private $address = "San Manuel, Pangasinan";
    private $contactNumber = "0966 198 1700";
    private $email = "costalesgellieanne@email.com";
    
    // Family Information
    private $fatherName = "Wellie Costales";
    private $fatherOccupation = "Self Employed";
    private $motherName = "Gemma Costales";
    private $motherOccupation = "Self Employed";
    
    // Educational Background
    private $elementary = "San Quintin Central School";
    private $highSchool = "San Quintin National High School";
    private $college = "Pangasinan State University";
    
    // Work Experience
    // private $currentJob = "Software Quality Engineer";
    // private $company = "HCL Technologies";
    // private $yearsOfExperience = "4 years";
    
    // Skills & Interests
    // private $skills = "Programming, Data Analysis, Machine Learning, Communication";
     private $hobbies = "Reading, Coding, Hiking, Photography";
     private $languages = "English, Tagalog";
      private $photoPath = "images/image.png"; 
      

    public function index()
    {
        // Get age translation based on age
        $ageTranslation = $this->getAgeTranslation($this->age);
        
        // Prepare data array with ALL variables
        $data = [
            'name' => $this->name,
            'age' => $this->age,
            'ageTranslation' => $ageTranslation,
            'gender' => $this->gender,
            'dateOfBirth' => $this->dateOfBirth,
            'birthPlace' => $this->birthPlace,
            'nationality' => $this->nationality,
            'civilStatus' => $this->civilStatus,
            'religion' => $this->religion,
            'height' => $this->height,
            'weight' => $this->weight,
            'address' => $this->address,
            'contactNumber' => $this->contactNumber,
            'email' => $this->email,
            'fatherName' => $this->fatherName,
            'fatherOccupation' => $this->fatherOccupation,
            'motherName' => $this->motherName,
            'motherOccupation' => $this->motherOccupation,
            'elementary' => $this->elementary,
            'highSchool' => $this->highSchool,
            'college' => $this->college,
           // 'currentJob' => $this->currentJob,
            //'company' => $this->company,
          //  'yearsOfExperience' => $this->yearsOfExperience,
            //'skills' => $this->skills,
           'hobbies' => $this->hobbies,
            'languages' => $this->languages,
              'photoPath' => $this->photoPath,
        ];
        
        // Select view based on gender
        if (strtolower($this->gender) === 'female') {
            return view('biodata.female', $data);
        } else {
            return view('biodata.male', $data);
        }
    }

    /**
     * Get age translation based on age conditions
     * 
     * @param int $age
     * @return string
     */
    private function getAgeTranslation($age)
    {
        if ($age == 21) {
            // Tagalog version
            return "Dalawampu't Isa";
        } elseif ($age >= 22 && $age <= 23) {
            // Ilocano version
            if ($age == 22) {
                return "Duapulo ket Dua";
            } else {
                return "Duapulo ket Tallo";
            }
        } elseif ($age > 24) {
            // Pangasinan version
            return $this->numberToPangasinan($age);
        } else {
            return "";
        }
    }

    /**
     * Convert number to Pangasinan
     * 
     * @param int $number
     * @return string
     */
    private function numberToPangasinan($number)
    {
        $pangasinanNumbers = [
            20 => "Duampulo",
            21 => "Duampulon sakey",
            22 => "Duampulon dua",
            23 => "Duampulon talo",
            24 => "Duampulon apat",
            25 => "Duampulon lima",
            26 => "Duampulon anem",
            27 => "Duampulon pito",
            28 => "Duampulon walo",
            29 => "Duampulon siam",
            30 => "Talompulo",
        ];

        // For ages 31 and above, construct dynamically
        if ($number >= 31 && $number <= 39) {
            $ones = $number - 30;
            $onesMap = [
                1 => "sakey", 2 => "dua", 3 => "talo", 4 => "apat", 
                5 => "lima", 6 => "anem", 7 => "pito", 8 => "walo", 9 => "siam"
            ];
            return "Talompulon " . $onesMap[$ones];
        }

        return $pangasinanNumbers[$number] ?? "Duampulon lima";
    }
}