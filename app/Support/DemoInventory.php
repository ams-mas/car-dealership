<?php
namespace App\Support;

class DemoInventory
{
    public static function all(): array
    {
        $rows = [
            [1,2023,'Mercedes-Benz','S 580','4MATIC',94500,18400,'Sedan','Gasoline','mercedes.jpg',true,false],
            [2,2022,'Porsche','911 Carrera S','Sport Chrono',119900,12200,'Coupe','Gasoline','porsche.jpg',true,false],
            [3,2024,'Land Rover','Range Rover','P400 SE',104500,8600,'SUV','Gasoline','hero.jpg',true,true],
            [4,2023,'BMW','740i','M Sport',72900,21500,'Sedan','Gasoline','bmw.jpg',true,true],
            [5,2024,'Audi','Q8','Premium Plus',68500,14000,'SUV','Gasoline','audi.jpg',false,true],
            [6,2022,'Mercedes-Benz','E 450','4MATIC',51900,29300,'Sedan','Gasoline','mercedes.jpg',false,false],
            [7,2024,'BMW','i4','eDrive40',47900,9200,'Hatchback','Electric','bmw.jpg',false,true],
            [8,2023,'Porsche','Cayenne','Platinum Edition',76900,16800,'SUV','Gasoline','porsche.jpg',false,false],
        ];
        return array_map(function ($r) {
            [$id,$year,$make,$model,$trim,$price,$miles,$body,$fuel,$image,$featured,$offer] = $r;
            return compact('id','year','make','model','trim','price','miles','body','fuel','image','featured','offer') + ['status'=>'Available','condition'=>'Used','transmission'=>'Automatic','stock'=>'DEMO-'.str_pad((string)$id,4,'0',STR_PAD_LEFT)];
        }, $rows);
    }
    public static function filter(array $filters): array
    {
        $cars = array_filter(self::all(), function ($car) use ($filters) {
            foreach (['make','model','body','fuel','condition','status','transmission'] as $key) {
                if (!empty($filters[$key]) && strcasecmp($car[$key], $filters[$key]) !== 0) return false;
            }
            if (($filters['category'] ?? '') === 'Electric' && $car['fuel'] !== 'Electric') return false;
            if (in_array($filters['category'] ?? '', ['SUV','Sedan','Truck','Hatchback']) && $car['body'] !== $filters['category']) return false;
            foreach (['min_price'=>['price',true],'max_price'=>['price',false],'min_year'=>['year',true],'max_year'=>['year',false],'max_miles'=>['miles',false]] as $key => [$field,$min]) {
                if (isset($filters[$key]) && $filters[$key] !== '' && ($min ? $car[$field] < $filters[$key] : $car[$field] > $filters[$key])) return false;
            }
            if (!empty($filters['q']) && !str_contains(strtolower($car['year'].' '.$car['make'].' '.$car['model'].' '.$car['trim']), strtolower($filters['q']))) return false;
            return true;
        });
        $sort = $filters['sort'] ?? 'newest';
        usort($cars, fn($a,$b) => match($sort) { 'price_asc'=>$a['price'] <=> $b['price'], 'price_desc'=>$b['price'] <=> $a['price'], 'mileage'=>$a['miles'] <=> $b['miles'], default=>$b['year'] <=> $a['year'] ?: $b['id'] <=> $a['id'] });
        return array_values($cars);
    }
}
