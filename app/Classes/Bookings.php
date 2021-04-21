<?php


namespace App\Classes;


use App\Booking;
use App\Events\BookinLogEvent;
use App\Vehicle;

class Bookings
{
    public function access($option, $var=0,$store=0){
        switch ($option){
            case 0: return Vehicle::with('Bookings')->with('ModelVehicle')->with('Brand')->where('id', $var)->first();
                break;
            case 1: return $this->createReserve($var);
                break;
            case 2: return $this->deleteReserve($var);
                break;
            case 3: return $this->updateReserve($var);
                break;
        }
    }
    protected function createReserve($request){
        $request = $request->all()['booking'];
        $bookings = Booking::with('User')->where('vehicle_id', $request['vehicle_id'])->get();
        $response = [];
        if ($request['vehicle_id'] <=0){
            $response['message'] = 'Veículo inválido!';
            $response['booking']=$bookings;
            return $response;
        }
        if ($request['user_id'] <=0){
            $response['message'] = 'Cliente Inválido!';
            $response['booking']=$bookings;
            return $response;
        }
        if ($request['start_date'] > $request['end_date']){
            $response['message'] = 'Data Final deve ser maior que a inicial!';
            $response['booking']=$bookings;
            return $response;
        }

        $booking = Booking::where(function ($query) use ($request) {
                $query->where('rent_start', '<=', $request['end_date'])->where('rent_end', '>=', $request['end_date'])->where('vehicle_id','=',$request['vehicle_id']);
            })->orWhere(function ($query) use ($request) {
                $query->where('rent_start', '>=', $request['start_date'])->where('rent_end', '<=', $request['end_date'])->where('vehicle_id','=',$request['vehicle_id']);
            })->orWhere(function ($query) use ($request) {
                $query->where('rent_start', '<=', $request['start_date'])->where('rent_end', '>=', $request['start_date'])->where('vehicle_id','=',$request['vehicle_id']);
            })->get();

        if (count($booking) == 0) {
            $booking = new Booking();
            $booking->rent_start = $request['start_date'];
            $booking->rent_end = $request['end_date'];
            $booking->vehicle_id = $request['vehicle_id'];
            $booking->user_id = $request['user_id'];
            if ($booking->save()) {
                $bookings = Booking::with('User')->where('vehicle_id', $request['vehicle_id'])->get();
                event(new BookinLogEvent($booking->user_id, $booking->vehicle_id));
                $response['message'] = 'Reserva efetuada com sucesso!';
                $response['booking']=$bookings;
            }
        }else{
            $response['message'] = 'Essa data já tem reserva!';
            $response['booking']=$bookings;
        }
        return $response;
    }
    protected function deleteReserve($request){
        $request = $request->all()['booking'];
        $response=[];
        if (Booking::destroy($request['id'])) {
            $bookings = Booking::with('User')->where('vehicle_id', $request['vehicle_id'])->get();
            $response['message'] = 'Reserva deletada com sucesso';
            $response['booking']=$bookings;
        }else{
            $bookings = Booking::with('User')->where('vehicle_id', $request['vehicle_id'])->get();
            $response['message'] = 'Veículo inválido!';
            $response['booking']=$bookings;
        }
        return $response;
    }
    protected function updateReserve($request){
        $request = $request->all()['booking'];
        $bookings = Booking::with('User')->where('vehicle_id', $request['vehicle_id'])->get();
        $response = [];
        if ($request['vehicle_id'] <=0){
            $response['message'] = 'Veículo inválido!';
            $response['booking']=$bookings;
            return $response;
        }
        if ($request['user_id'] <=0){
            $response['message'] = 'Cliente Inválido!';
            $response['booking']=$bookings;
            return $response;
        }
        if ($request['start_date'] > $request['end_date']){
            $response['message'] = 'Data Final deve ser maior que a inicial!';
            $response['booking']=$bookings;
            return $response;
        }

        $booking = Booking::where(function ($query) use ($request) {
            $query->where('rent_start', '<=', $request['end_date'])->where('rent_end', '>=', $request['end_date'])->where('vehicle_id','=',$request['vehicle_id']);
        })->orWhere(function ($query) use ($request) {
            $query->where('rent_start', '>=', $request['start_date'])->where('rent_end', '<=', $request['end_date'])->where('vehicle_id','=',$request['vehicle_id']);
        })->orWhere(function ($query) use ($request) {
            $query->where('rent_start', '<=', $request['start_date'])->where('rent_end', '>=', $request['start_date'])->where('vehicle_id','=',$request['vehicle_id']);
        })->get();

        if (count($booking) == 0) {
            $booking = Booking::find($request['id']);
            $booking->rent_start = $request['start_date'];
            $booking->rent_end = $request['end_date'];
            $booking->vehicle_id = $request['vehicle_id'];
            $booking->user_id = $request['user_id'];
            if ($booking->save()) {
                $bookings = Booking::with('User')->where('vehicle_id', $request['vehicle_id'])->get();
                event(new BookinLogEvent($booking->user_id, $booking->vehicle_id));
                $response['message'] = 'Reserva alterada com sucesso!';
                $response['booking']=$bookings;
            }
        }else{
            $response['message'] = 'Essa data já tem reserva!';
            $response['booking']=$bookings;
        }
        return $response;
    }



}
