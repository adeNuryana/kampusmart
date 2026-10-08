<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    private const EMAILS = [
        'aisyahwati955@gmail.com',
        'adndawdya01@gmail.com',
        'adrianyoga2026@gmail.com',
        'aldennadira@gmail.com',
        'alfinabahdinaa@gmail.com',
        'fukamifuu28@gmail.com',
        'ramadhanianindya2909@gmail.com',
        'annisanis704@gmail.com',
        'rasyaaryaprtama27@gmail.com',
        'hyungwonbini@gmail.com',
        'armaynius30@gmail.com',
        'arnimanzega3@gmail.com',
        'audyayunovitasari19@gmail.com',
        'avicenanizar07@gmail.com',
        'salmaroychanah@gmail.com',
        'bungatiara647@gmail.com',
        'chesyawinzky@gmail.com',
        'debbymahalia7045@gmail.com',
        'dn6301970@gmail.com',
        'dhyaafauzii@gmail.com',
        'dimasaditiya2536@gmail.com',
        'triabaini@gmail.com',
        'dinasalma2303@gmail.com',
        'utamidini315@gmail.com',
        'dominicojosse17@gmail.com',
        'dwiputriwulandarii27@gmail.com',
        'echadwii123@gmail.com',
        'fajarwidianto95@gmail.com',
        'farellino95@gmail.com',
        'fathirazzamsyah06@gmail.com',
        'wulandariwulan1945@gmail.com',
        'fbryanardiansyah@gmail.com',
        'femiagustina05@gmail.com',
        'ferlianaenjellita@gmail.com',
        'shelvifery@gmail.com',
        'frmnsyhf303030@gmail.com',
        'fitriauliamtd@gmail.com',
        'hafiztraufelshirazy@gmail.com',
        'hanakamila2007@gmail.com',
        'harsyaramdhan2@gmail.com',
        'heldina.anasthasya01@gmail.com',
        'ibnufarhan1206@gmail.com',
        'ilham.bayu2007@gmail.com',
        'indahzanuar05@gmail.com',
        'jtoti799@gmail.com',
        'kaylaramadani0409@gmail.com',
        'kaylamuthia08@gmail.com',
        'kelvin2007maulana@gmail.com',
        'vandaaa2008@gmail.com',
        'khaeratulcahyanabila@gmail.com',
        'kristianto190407@gmail.com',
        'lorrisdianymahesaayu@gmail.com',
        'makhirotulilmiyah@gmail.com',
        'flenidelan@gmail.com',
        'melisanatalia216@gmail.com',
        'dimasbroit19@gmail.com',
        'muhammadgrandisputra@gmail.com',
        'muhammadgani712@gmail.com',
        'kamilnaufal2008@gmail.com',
        'owijaya131@gmail.com',
        'rifqisyafaruddin@gmail.com',
        'mroofiansyah@gmail.com',
        'munajatyusro@gmail.com',
        'muthiasaffana112@gmail.com',
        'nadineyoshe863@gmail.com',
        'nadjwaazzahra44@gmail.com',
        'nahdasayyidah17@gmail.com',
        'najwaazizah0709@gmail.com',
        'nazwaarrhm17@gmail.com',
        'nurulhidayah9552@gmail.com',
        'panjiprasety734@gmail.com',
        'putrihanifah385@gmail.com',
        'queishahizzagina@gmail.com',
        'radhitalfiansyah28@gmail.com',
        'rafifrabani1212@gmail.com',
        'rayzaid2727@gmail.com',
        'ahmadfauzirasya@gmail.com',
        'rifky.adi241007@gmail.com',
        'riskonramadani17@gmail.com',
        'septiabelarepi@gmail.com',
        'ssaiful.islam02001@gmail.com',
        'salwaoktaviani484@gmail.com',
        'salwa12zahra06@gmail.com',
        'samuelronggurtohang@gmail.com',
        'shafaworkk4@gmail.com',
        'jayashinta1@gmail.com',
        'sintianovianti0106@gmail.com',
        'siskapranpriska@gmail.com',
        'sfadilahh14@gmail.com',
        'srimailanihsrimailanih@gmail.com',
        'syhafiraazzikra87@gmail.com',
        'taqiyyahtaqwa44@gmail.com',
        'tikatrianaputri5@gmail.com',
        'abitazzikhri@gmail.com',
        'rhmavlda@gmail.com',
        'vanyaaurelliaputri19@gmail.com',
        'fensinaikteas@gmail.com',
        'wahyuadic07@gmail.com',
        'herandiwilhamnabil@gmail.com',
        'zahradinakhama@gmail.com',
        'zlfnazhifah16@gmail.com',
    ];

    public function run(): void
    {
        $password = Hash::make('123456789');

        DB::transaction(function () use ($password): void {
            foreach (self::EMAILS as $email) {
                $seller = User::firstOrNew(['email' => $email]);

                $seller->name = '-';
                $seller->phone = '-';
                $seller->password = $password;
                $seller->role = 'seller';
                $seller->status = 'active';
                $seller->email_verified_at = now();
                $seller->photo = null;

                $seller->save();

                $seller->sellerProfile()->updateOrCreate(
                    [],
                    [
                        'store_name' => '-',
                        'whatsapp' => '-',
                        'nim' => '-',
                        'faculty' => '-',
                        'description' => '-',
                        'photo' => null,
                    ],
                );
            }
        });
    }
}
