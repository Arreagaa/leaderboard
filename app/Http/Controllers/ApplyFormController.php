<?php

namespace App\Http\Controllers;

use App\Mail\NotificationSponsor;
use App\Mail\NotificationUser;
use App\Mail\RegisterUser;
use App\Mail\RequestClase;
use App\Mail\RequestSponsor;
use App\Mail\RequestVolunteer;
use App\Models\ApplyClass;
use App\Models\ApplyUser;
use App\Models\ApplySponsor;
use App\Models\ApplyUserClaseTeam;
use App\Models\ApplyVoluteer;
use App\Models\ClaseSchedule;
use App\Models\ClaseScheduleTeam;
use App\Models\ClaseScheduleUser;
use App\Models\ClaseTeam;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ApplyFormController extends Controller
{
    private const DESTINATION = 'tecumaninvitational@gmail.com';

    public function mail()
    {
        $user = ApplyUser::find(4);
        Mail::to([self::DESTINATION])->send(new NotificationUser($user));
    }

    public function storeVoluteer(){
        $data = request()->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:apply_voluteers',
            'experience' => 'required',
            'age' => 'required|integer',
            'phone' => 'required',
        ]);
        $user = ApplyVoluteer::create($data);

        Mail::to([self::DESTINATION])->send(new RequestVolunteer($user));

        return Redirect::route('register.volunteer');
    }

    public function storeSponsor(){
        $data = request()->validate([
            'company' => 'required',
            'industry' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:apply_sponsors',
            'phone' => 'required',
            'description' => 'required',
        ]);

        $user = ApplySponsor::create($data);
        
        Mail::to([$user->email])->send(new NotificationSponsor($user));
        Mail::to([self::DESTINATION])->send(new RequestSponsor($user));

        return Redirect::route('register.sponsor');
    }

    public function storeClass(){
        $data = request()->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:apply_voluteers',
        ]);
        $user = ApplyClass::create($data);

        return Redirect::route('register.volunteers');
    }

    public function storeUser(){
        $data = request()->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:apply_users',
            'date_of_birth' => 'required',
            'dpi' => 'required',
            'phone' => 'required',
            'sex' => 'required'
        ]);

        $user = new ApplyUser();
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->dpi = $data['dpi'];
        $user->phone = $data['phone'];
        $user->sex = $data['sex'];

        $user->save();

        $qr = QrCode::format('png')
            ->size(300)
            ->generate(config('app.url').'/user/info/' . Crypt::encryptString($user->id));

        Storage::disk('public')->put('users/qr/qr' . $user->id, $qr);
        $user->qr = '/storage/users/qr/qr' . $user->id;
        $user->save();

        Mail::to([$user->email])->send(new NotificationUser($user));
        
        return Redirect::route('register.user');
    }

    public function indexCycling(){
        return Inertia::render('Registers/clase/LClaseSimple', [
            'type' => 'cycling',
            'title' => 'Ciclismo',
        ]);
    }

    private function storeVoucher($file){
        return Storage::disk('public')->put('vouchers', $file);
    }

    private function createUser($request){
        $data = $request->validate([
            'user.name' => 'required',
            'user.lastname' => 'required',
            //'email' => 'required|email|unique:apply_notifications',
            'user.email' => 'required',
            'user.date_of_birth' => 'required',
            'user.dpi' => 'required',
            'user.phone' => 'required',
            'user.sex' => 'required',
            'user.voucher'  => 'required',
            'user.name_contact_emergency' => 'required',
            'user.phone_contact_emergency' => 'required',
            'user.shirt_size' => 'required',
        ]);

        $user = new ApplyUser();
        $user->name = $data['user']['name'];
        $user->lastname = $data['user']['lastname'];
        $user->email = $data['user']['email'];
        $user->date_of_birth = $data['user']['date_of_birth'];
        $user->dpi = $data['user']['dpi'];
        $user->phone = $data['user']['phone'];
        $user->sex = $data['user']['sex'];
        $user->name_contact_emergency = $data['user']['name_contact_emergency'];
        $user->phone_contact_emergency = $data['user']['phone_contact_emergency'];
        $user->shirt_size = $data['user']['shirt_size'];

        $user->type = 'individual';
        $user->save();


        $qr = QrCode::size(300)
            ->format('png')
            ->generate(config('app.url').'/user/info/clase/' . Crypt::encryptString($user->id));

        Storage::disk('public')->put('users/qr/qr' . $user->id, $qr);
        $user->qr = '/storage/users/qr/qr' . $user->id;

        $user->voucher = $this->storeVoucher($data['user']['voucher']);
        $user->save();

        $schedule = new  ClaseScheduleUser();
        $schedule->clase_schedule_id = $request->schedule;
        $schedule->apply_user_id = $user->id;
        $schedule->save();

        return $user;
    }

    private function onlyUser($data, $schedule, $name, $category, $voucher, $type){
        $user = new ApplyUser();
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->dpi = $data['dpi'];
        $user->phone = $data['phone'];
        $user->sex = $data['sex'];
        $user->name_contact_emergency = $data['name_contact_emergency'];
        $user->phone_contact_emergency = $data['phone_contact_emergency'];
        $user->shirt_size = $data['shirt_size'];
        $str = strtolower($name);
        $user->team_id = str_replace(" ", "", $str);
        $user->type = $type;
        $user->save();

        $qr = QrCode::size(300)
            ->format('png')
            ->generate(config('app.url').'/user/info/clase/' . Crypt::encryptString($user->id));

        Storage::disk('public')->put('users/qr/qr' . $user->id, $qr);
        $user->qr = '/storage/users/qr/qr' . $user->id;
        
        $user->voucher = $this->storeVoucher($voucher);
        $user->save();

        $scheduleUser = new  ClaseScheduleUser();
        $scheduleUser->clase_schedule_id = $schedule;
        $scheduleUser->apply_user_id = $user->id;
        $scheduleUser->category = $category;
        $scheduleUser->save();

        return $user;
    }

    public function duatlonCategories(){
        return [
            [
                'name' => 'Individual Masculino',
                'id' => 'individual-masculino',
            ],
            [
                'name' => 'Individual Femenino',
                'id' => 'individual-femenino',
            ],
            [
                'name' => 'Relevos',
                'id' => 'relevos',
            ],
        ];
    }

    public function storeCycling(){
        $user = $this->createUser(request());
        $user->type = 'ciclismo';

        Mail::to([$user->email])->send(new RequestClase($user));
        return Redirect::route('register.clase.cycling');
    }

    public function indexYoga(){
        return Inertia::render('Registers/clase/LClaseSimple', [
            'type' => 'yoga',
            'title' => 'Yoga',
            
        ]);
    }

    public function storeYoga(){
        $user = $this->createUser(request());
        $user->type = 'yoga';

        Mail::to([$user->email])->send(new RequestClase($user));

        return Redirect::route('register.clase.yoga');
    }

    public function indexFittestDuo(){
        return Inertia::render('Registers/clase/LClaseMultiple', [
            'type' => 'fittestduo',
            'title' => 'Fittest Duo',
            'maxUsers' => 2
        ]);
    }

    public function storeFittestDuo(){
        request()->validate([
            'name' => 'required',
            'voucher' => 'required',
            'schedule' => 'required',
        ]);
        $max = 3;
        
        for ($i=1; $i < $max; $i++) { 
            request()->validate([
                "users." . $i . ".name" => 'required',
                'users.' . $i . '.lastname' => 'required',
                //'email' => 'required|email|unique:apply_notifications',
                'users.' . $i . '.email' => 'required',
                'users.' . $i . '.date_of_birth' => 'required',
                'users.' . $i . '.dpi' => 'required',
                'users.' . $i . '.phone' => 'required',
                'users.' . $i . '.sex' => 'required',
                'users.' . $i . '.name_contact_emergency' => 'required',
                'users.' . $i . '.phone_contact_emergency' => 'required',
                'users.' . $i . '.shirt_size' => 'required',
            ]);
        }

        $team = new ClaseTeam();
        $team->name = request()->name;
        $team->voucher = '';
        $team->save();

        $team->voucher = $this->storeVoucher(request()->voucher);
        $team->save();

        $teamSchedule = new ClaseScheduleTeam();
        $teamSchedule->clase_schedule_id = request()->schedule;
        $teamSchedule->clase_team_id = $team->id;
        $teamSchedule->save();

        for ($i=1; $i < $max; $i++) { 
            $user = $this->onlyUser(request()->users[$i], request()->schedule, request()->name, '', request()->voucher, 'team');
        
            $user_team = new ApplyUserClaseTeam();
            $user_team->apply_user_id = $user->id;
            $user_team->clase_team_id = $team->id;
            $user_team->save();

            $user->type = 'fittest duo';
            Mail::to([$user->email])->send(new RequestClase($user));
        }

        return Redirect::route('register.clase.fittestduo');
    }
    
    public function indexDuatlon(){
        return Inertia::render('Registers/clase/LClaseMultiple', [
            'type' => 'duatlon',
            'title' => 'Duatlón',
        ]);
    }

    public function storeDuatlon(){
        request()->validate([
            'name' => 'required',
            'voucher' => 'required',
            'category' => 'required',
            'schedule' => 'required',
        ]);
        $max = 2;
        $type = 'individual';
        if(request()->category == 'relevos'){
            $max = 4;
            $type = 'team';
        }
        
        for ($i=1; $i < $max; $i++) { 
            request()->validate([
                "users." . $i . ".name" => 'required',
                'users.' . $i . '.lastname' => 'required',
                //'email' => 'required|email|unique:apply_notifications',
                'users.' . $i . '.email' => 'required',
                'users.' . $i . '.date_of_birth' => 'required',
                'users.' . $i . '.dpi' => 'required',
                'users.' . $i . '.phone' => 'required',
                'users.' . $i . '.sex' => 'required',
                'users.' . $i . '.name_contact_emergency' => 'required',
                'users.' . $i . '.phone_contact_emergency' => 'required',
                'users.' . $i . '.shirt_size' => 'required',
            ]);
        }

        if(request()->category == 'relevos'){
            $team = new ClaseTeam();
            $team->name = request()->name;

            $team->voucher = Storage::putFile('vouchers', request()->voucher, 'public');
            $team->save();

            $teamSchedule = new ClaseScheduleTeam();
            $teamSchedule->clase_schedule_id = request()->schedule;
            $teamSchedule->clase_team_id = $team->id;
            $teamSchedule->save();
        }

        for ($i=1; $i < $max; $i++) { 
            $user = $this->onlyUser(request()->users[$i], request()->schedule, request()->name, request()->category, request()->voucher, $type);
        
            if(request()->category == 'relevos'){
                $user_team = new ApplyUserClaseTeam();
                $user_team->apply_user_id = $user->id;
                $user_team->clase_team_id = $team->id;
                $user_team->save();
            }

            $user->type = 'duatlón';
            Mail::to([$user->email])->send(new RequestClase($user));
        }

        return Redirect::route('register.clase.duatlon');
        
    }

    public function schedules(){
        $type = request()->type;
        $schedules = ClaseSchedule::withCount([
            'users' => function (Builder $query) {
                $query->where('approved', true)->orWhere('approved', null);
            },
        ])->where('type', $type)->get();

        return response()->json($schedules);
    }
}
