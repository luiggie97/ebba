<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><h3>Reservas</h3></div>
                    <div class="card-body">
                        <div class="alert alert-info" v-if="response.length > 0">
                            <ul>
                                <li v-for="item in response">{{item}}</li>
                            </ul>
                        </div>
                        <div id="list" v-if="this.type === 'list'">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <img :src="this.vehicle.photo" class="img-fluid align-content-center" style="max-width:100px;"/>
                                </div>
                                <div class="col-lg-12">
                                    <h5>Veículo</h5>
                                    <hr/>
                                    <ul v-if="this.vehicle.model_vehicle != undefined">
                                        <li><b>ID: </b> {{this.vehicle.id}}</li>
                                        <li><b>Marca: </b> {{this.vehicle.brand.name}}</li>
                                        <li><b>Modelo: </b> {{this.vehicle.model_vehicle.name}}</li>
                                        <li><b>Ano Modelo: </b> {{this.vehicle.year}}</li>
                                        <li><b>Placa: </b> {{this.vehicle.plate}}</li>
                                        <li><b>Tipo: </b> {{this.vehicle.type}}</li>
                                        <li><b>Descrição: </b> {{this.vehicle.description}}</li>
                                    </ul>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-lg-10">
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-primary" v-on:click="Reserve()">Reservar</button>
                                </div>
                                <div class="col-lg-12">
                                    <hr/>
                                    <h5>Reservas</h5>
                                    <table class="table table-hover table-responsive-lg">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Dia Inicial</th>
                                            <th>Dia Final</th>
                                            <th>Cliente</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="item in vehicle.bookings">
                                            <th scope="row">{{item.id}}</th>
                                            <td>{{item.rent_start}}</td>
                                            <td>{{item.rent_end}}</td>
                                            <td>{{item.user.name}}</td>
                                            <td>
                                                <a v-on:click="BookingUpdate(item.id, item.vehicle_id, item.rent_start, item.rent_end, item.user_id)"
                                                   v-if="item.user_id == user.id || user.admin">
                                                    <i class="fas fa-edit" style="color:blue"></i>
                                                </a> |
                                                <a  v-on:click="BookingDelete(item.id, item.vehicle_id)"
                                                   v-if="item.user_id == user.id || user.item">
                                                    <i class="fas fa-trash-alt" style="color:red"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="reserve" v-if="this.type === 'reserve'">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Registrar Agendamento</h5>
                                    <hr/>
                                    <div class="form-group">
                                        <label for="start_date_reserve">Data Inicial</label>
                                        <input type="date" class="form-control" id="start_date_reserve"
                                               v-model="reserve.start_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date_reserve">Data Final</label>
                                        <input type="date" class="form-control" id="end_date_reserve"
                                               v-model="reserve.end_date" required>
                                    </div>
                                    <div class="d-flex ">
                                        <button class="btn btn-success mr-3" v-on:click="BookingReserve()">Reservar</button>
                                        <button class="btn btn-danger" v-on:click="BookingList()">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="update" v-if="this.type === 'update'">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Editar Reserva</h5>
                                    <hr/>
                                    <div class="form-group">
                                        <label for="start_date_edit">Data Inicial</label>
                                        <input type="date" class="form-control" id="start_date_edit"
                                               v-model="reserve.start_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date_edit">Data Final</label>
                                        <input type="date" class="form-control" id="end_date_edit"
                                               v-model="reserve.end_date" required>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-success" v-on:click="BookingReserve()">Editar Reserva</button>
                                        <button class="btn btn-danger" v-on:click="BookingList()">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BookingVehicleComponent",
        props: ['p_vehicle', 'p_user'],
        data: function () {
            return {
                vehicle: '',
                type: 'list',
                reserve: {
                    start_date: '',
                    end_date: '',
                    id: 0,
                    booking_id: 0,
                    vehicle_id: 0,
                    user_id: 0
                },
                user: '',
                response: []
            }
        },
        methods: {
            BookingReserve() {
                this.response = [];
                if (this.type == 'reserve') {
                    axios.post('/booking/create', {
                        booking: this.reserve
                    }).then(response => {
                        this.response.push(response.data.status);
                        if(response.status == 200) {
                            this.vehicle.bookings = response.data.bookings;
                            this.BookingList();
                        }
                    }).catch(response => {
                        this.response.push(response);
                    });
                } else {
                    axios.post('/booking/edit/'+this.reserve.id, {
                        booking: this.reserve
                    }).then(response => {
                        this.response.push(response.data.status);
                        if(response.status == 200) {
                            this.vehicle.bookings = response.data.bookings;
                            this.BookingList();
                        }
                    }).catch(response => {
                        this.response.push(response);
                    });
                }
            },
            BookingDelete(id, vehicle_id) {
                this.response = [];
                this.reserve.id = id;
                this.vehicle_id = vehicle_id;
                axios.post('/booking/destroy/'+id, {
                    booking: this.reserve
                }).then(response => {
                    this.response.push(response.data.status);
                    if(response.status == 200) {
                        this.vehicle.bookings = response.data.bookings;
                        this.BookingList();
                    }
                }).catch(response => {
                    this.response.push(response);
                });
            },
            BookingUpdate(id, vehicle_id, rent_start, rent_end, user_id) {
                this.response = [];
                this.type = 'update';
                this.reserve.id = id;
                this.reserve.start_date = rent_end;
                this.reserve.end_date = rent_start;
                this.reserve.user_id = user_id;
                this.vehicle_id = vehicle_id;
            },
            Reserve() {
                this.response = [];
                this.type = 'reserve';
                this.reserve.start_date = '';
                this.reserve.end_date = '';
            },
            BookingList() {
                this.type = 'list';
            }
        },
        mounted() {
            this.user = this.p_user;
            this.vehicle = this.p_vehicle;
            console.log(this.vehicle);
            this.reserve.vehicle_id = this.vehicle.id;
            this.reserve.user_id = this.p_user.id;
        },
    }
</script>

<style scoped>

</style>
