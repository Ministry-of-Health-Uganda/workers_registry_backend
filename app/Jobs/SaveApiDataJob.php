<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Models\Practioner;
use App\Models\PractionerCitizenship;
use App\Models\PractionerContact;
use App\Models\PractionerEducation;
use App\Models\PractionerGazette;
use App\Models\PractionerIdentity;
use App\Models\PractionerKinship;
use App\Models\PractionerLanguage;
use App\Models\PractionerLicence;
use App\Models\PractionerPosition;
use App\Models\PractionerRegistration;
use App\Models\PractionerTrainingInfo;


class SaveApiDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $apiPractioners;
    protected $linkId;
    protected $practioner;

    public function __construct($data, $linkId)
    {
        $this->apiPractioners   = $data;
        $this->linkId = $linkId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Fetch for link ".$this->linkId);
       // Log::info(json_encode($this->data));
        $this->savePractioner($this->apiPractioners);
        
    }

    public function savePractioner($apiPractioners){

        foreach ($apiPractioners as $apiPractioner):
        
            $practioner = new Practioner();

            $practioner->surname   =  $apiPractioner->surname;
            $practioner->firstname =  $apiPractioner->firstname;
            $practioner->othername =  $apiPractioner->othername;
            $practioner->gender    =  $apiPractioner->gender;
            $practioner->maritalStatus   =  $apiPractioner->maritalStatus;
            $practioner->photo       =  $apiPractioner->photo;
            $practioner->birthDate   =  $apiPractioner->birthDate;
            $practioner->countryOfOrigin =  $apiPractioner->countryOfOrigin;
            $practioner->district  =  $apiPractioner->district;
            $practioner->subCounty =  $apiPractioner->subCounty;
            $practioner->parish    =  $apiPractioner->parish;
            $practioner->subCounty =  $apiPractioner->subCounty;

            $practioner->save();

            $this->practioner = $practioner;

            //insert into ohers to

//Citizenship

            if($apiPractioner->citizenship && isset($apiPractioner->citizenship->country)):

                $citizenship = new PractionerCitizenship();

                $citizenship->practioner_id = $this->practioner->id;
                $citizenship->practioner_id = ($apiPractioner->citizenship->country)?$apiPractioner->citizenship->country:'';
                $citizenship->save();

             endif;
       
             $contact = new PractionerContact();

             $conta = $apiPractioner->contact;

             $contact->practioner_id = $this->practioner->id;
             $contact->phone1 = $conta->phone1;
             $contact->phone2 = $conta->phone2;
             $contact->email1 = $conta->email1;
             $contact->email2 = $conta->email2;

             $contact->emergencyContactName = $conta->emergencyContact->name;
             $contact->emergencyContactNamephone = $conta->emergencyContact->phone;
             $contact->mobileMoneyName  = $conta->mobileMoney->name;
             $contact->mobileMoneyPhone = $conta->mobileMoney->phone;
             $contact->kycVerified      = ($conta->mobileMoney->kycVerified!=='')?$conta->mobileMoney->kycVerified:0;

             $contact->save();
        

    //Gazette
            $gazette = new PractionerGazette();

            $gaz = $apiPractioner->professionalGazzette;

            $gazette->practioner_id  = $this->practioner->id;
            $gazette->registrationNo = $gaz->registrationNo;
            $gazette->startDate      = $gaz->startDate;
            $gazette->endDate        = $gaz->endDate;

            $gazette->save();
        
    //Education
            $education = new PractionerEducation();

            $educ = $apiPractioner->education;
            
            $education->practioner_id  = $this->practioner->id;
            $education->primary  = $educ->primary;
            $education->lower_secondary  = $educ->secondary->ordinary;
            $education->upper_secondary  = $educ->secondary->upper;
            $education->tertiary  = $educ->tertiary;
            $education->other     = $educ->other;
            $education->speciality= $educ->speciality;

             $education->save();

    
     //identity
            $identity = new PractionerIdentity();

            $ident = $apiPractioner->identity->uhwr;
            
            $identity->practioner_id  = $this->practioner->id;
            $identity->nin            = $ident->nationalID->nin;
            $identity->cardNo         = $ident->nationalID->cardNo;
            $identity->ninExpriy      = $ident->nationalID->expiryDate;
            $identity->passportNo     = $ident->passport->passportNo;

            if($ident->passport && $ident->passport->passportExpiryDate)
                $identity->passportExpiryDate  = $ident->passport->passportExpiryDate;
            if($ident->passport && $ident->passport->regNo)
                $identity->driverLicenceNo     = $ident->driverLicense->regNo;
            if($ident->passport && $ident->passport->expiryDate)
                $identity->driverExpiryDate    = $ident->driverLicense->expiryDate;

            $identity->employeeIPPS        = $ident->employeeIPPS;

            $identity->save();
       
  
       //nextOfKin
            if($apiPractioner->nextOfKin):

                foreach($apiPractioner->nextOfKin as $person):

                $kin = new PractionerKinship();
                $kin->practioner_id  = $this->practioner->id;
                $kin->name     = $person->name;
                $kin->type     = $person->type;

                $kin->save();

                endforeach;
            endif;
        
 
       //positionInformation
            if($apiPractioner->positionInformation):

                foreach($apiPractioner->positionInformation as $post):

                    $pos = new PractionerPosition();

                    $pos->practioner_id    = $this->practioner->id;
                    $pos->startDate        = $post->startDate;
                    $pos->endDate          = $post->endDate;
                    $pos->dateOfFirst      = $post->dateOfFirst;
                    $pos->positionStatus   = $post->positionStatus;
                    $pos->employmentTerms  = $post->employmentTerms;
                    $pos->cadre         = $post->cadre;
                    $pos->workingHours  = $post->workingHours;

                    if($post->facility):

                        $pos->facilityType  = $post->facilityType;
                        $pos->instituteCategory  = $post->instituteCategory;
                        $pos->instituteType      = $post->instituteType;
                        $pos->district        = $post->district;
                        $pos->region          = $post->degion;
                        $pos->dhis2Id         = $post->dhis2Id;
                        $pos->ihrisId         = $post->ihrisId;
                        $pos->facilityRegId   = $post->facilityRegId;
                        $pos->facilityName    = $post->facilityName;

                    endif;

                    $pos->save();

                endforeach;
            endif;
        
    
    //professionalRegistration

            $reg = new PractionerRegistration();

            $registration = $apiPractioner->professionalRegistration;

            $reg->practioner_id  = $this->practioner->id;
            $reg->professionalCouncil = $registration->professionalCouncil;
            $reg->dateOfRegistration  = $registration->dateOfRegistration;
            $reg->registrationNo      = $registration->registrationNo;

            $reg->save();
        
   
    //langauge
            $languages = $apiPractioner->langauge;

            foreach ($languages as $lan) {

                $lang = new PractionerLanguage();

                $lang->practioner_id  = $this->practioner->id;
                $lang->name         = $lan->name;
                $lang->proficiency  = $lan->proficiency;

                $lang->save();
            }
       
    //professionalLicense
            $lic = $apiPractioner->professionalLicense;

            $licence = new PractionerLicence();

            $licence->practioner_id  = $this->practioner->id;
            $licence->professionalCouncil  = $lic->professionalCouncil;
            $licence->dateOfIssue  = $lic->dateOfIssue;
            $licence->dateOfExpiry = $lic->dateOfExpiry;
            $licence->attachment   = $lic->attachment;
            $licence->licenseNo    = $lic->licenseNo;

            $licence->save();
 
   //trainingInformation
           $trains = $apiPractioner->trainingInformation;

           foreach ($trains as $trn):
            
            $training = new PractionerTrainingInfo();

            $training->practioner_id    = $this->practioner->id;
            $training->trainingProvider = $trn->trainingProvider;
            $training->program  = $trn->program;
            $training->dateFrom = $trn->dateFrom;
            $training->dateTo   = $trn->dateTo;
            $training->trainer  = $trn->trainer;

            $training->save();

           endforeach;

    endforeach;
     
    }
    
}
