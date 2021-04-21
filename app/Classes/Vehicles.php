<?php


namespace App\Classes;


use App\Brands;
use App\ModelVehicle;
use App\Vehicle;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Vehicles
{
    public function access($option, $var=0,$store=0){
        switch ($option){
            case 0: return Vehicle::all();
                break;
            case 1: return $this->deleteVehicle($var);
                break;
            case 2: return $this->validate($var,$store);
                break;
            case 3: return Vehicle::find($var);
                break;
        }
    }

    protected function validate($request,$store){
        $validatedData = $request->validate([
            'plate' => 'required|unique:vehicles',
            'year' => 'required',
            'brand' => 'required',
            'model_vehicle' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required'
        ]);
        switch ($store){
            case 0: return $this->createVehicle($request);
                break;
            case 1: return $this->updateVehicle($request);
                break;
        }

    }
    protected function createVehicle($request){
        $formatedModel = strtoupper($request['model_vehicle']);
        $model = ModelVehicle::where(['name' => $formatedModel])->first();
        if(!$model){
            $model = new ModelVehicle();
            $model->name = $formatedModel;
            $model->save();
        }
        $formatedBrand = strtoupper($request['brand']);
        $brand = Brands::where(['name' => $formatedBrand])->first();
        if(!$brand){
            $brand = new Brands();
            $brand->name = $formatedBrand;
            $brand->model_id = $model->id;
            $brand->save();
        }

        //$imagePath = $request['photo']->store('imgVehicles');
        $request->photo->move(public_path('images'),$request['photo']->getClientOriginalName());
        $vehicle = new Vehicle();
        $vehicle->brand_id = $brand->id;
        $vehicle->model_vehicle_id = $model->id;
        $vehicle->photo = $request['photo']->getClientOriginalName();
        $vehicle->plate = $request['plate'];
        $vehicle->type = $request['type'];
        $vehicle->description = $request['description'];
        $vehicle->year = $request['year'];

        if($vehicle->save())
            return "Veículo criado com sucesso!";
        return "Ocorreu um erro ao criar o veículo!";
    }
    protected function updateVehicle($request){
        $formatedModel = strtoupper($request['model_vehicle']);
        $model = ModelVehicle::where(['name' => $formatedModel])->first();
        if(!$model){
            $model = new ModelVehicle();
            $model->name = $formatedModel;
            $model->save();
        }
        $formatedBrand = strtoupper($request['brand']);
        $brand = Brands::where(['name' => $formatedBrand])->first();
        if(!$brand){
            $brand = new Brands();
            $brand->name = $formatedBrand;
            $brand->model_id = $model->id;
            $brand->save();
        }

        $request->photo->move(public_path('images'),$request['photo']->getClientOriginalName());
        $vehicle = Vehicle::find($request['id']);
        //dd(asset('images/'.$vehicle->photo));
        File::delete('images/'.$vehicle->photo);
        //Storage::delete(asset('images/'.$vehicle->photo));
        $vehicle->brand_id = $brand->id;
        $vehicle->model_vehicle_id = $model->id;
        $vehicle->photo = $request['photo']->getClientOriginalName();
        $vehicle->plate = $request['plate'];
        $vehicle->type = $request['type'];
        $vehicle->description = $request['description'];
        $vehicle->year = $request['year'];
        if($vehicle->save())
            return "Veículo Atualizado com sucesso!";
        return "Ocorreu um erro ao atualizar o veículo!";
    }
    protected function deleteVehicle($id){
        $photo = Vehicle::find($id)->value('photo');
        if(Vehicle::destroy($id)){
            File::delete('images/'.$photo);
            return "Veículo deletado com sucesso!";
        }
        return "Ocorreu um erro ao deletar o veículo!";
    }


}
