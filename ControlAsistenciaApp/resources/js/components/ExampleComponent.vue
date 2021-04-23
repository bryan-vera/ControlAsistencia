<template>
  <div class="container container-task" style="text-align:center;">
    <div class="row" style="justify-content: center;">
      <div class="col-md-6">
        <div class="form-group">
          <label>Empleado</label>
          <select v-model="selected_Empleado" id="" class="form-control">
            <option disabled value="">Seleccione un empleado</option>
            <option
              v-for="(nombre, index) in arrayEmpleados"
              v-bind:key="index"
              v-bind:value="index"
            >
              {{ nombre }}
            </option>
          </select>
          <label>Tipo de marcacion</label>
          <select v-model="selected_tipoMarcacion" class="form-control">
            <option disabled value="">Seleccione un tipo</option>
            <option>Entrada</option>
            <option>Almuerzo inicio</option>
            <option>Almuerzo fin</option>
            <option>Salida</option>
          </select>
          <label>Fecha y hora de registro</label>
          <datetime
            type="datetime"
            input-class="form-control"
            v-model="selected_fechaHora"
            format="dd-MM-yyyy HH:mm:ss"
            zone="local"
            value-zone="local"
          ></datetime>
        </div>
        <div class="container-buttons">
          <button @click="agregarMarcacion()" class="btn btn-success col-5">
            Añadir
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" style="text-align: -webkit-center;">
        <h2>Lista de marcaciones</h2>
        <div v-for="track in arrayFechas" :key="track.fecha">
          <div style="text-align: center">
            <input v-model="selected_fechaTabla" v-bind="track.fecha" />
            <h2>{{ track.fecha }}</h2>
          </div>
          <table class="table text-center">
            <thead>
              <tr>
                <th scope="col">Nombres</th>
                <th scope="col">Entrada</th>
                <th scope="col">Almuerzo Inicio</th>
                <th scope="col">Almuerzo Regreso</th>
                <th scope="col">Salida</th>
                <th scope="col">Cumplimiento</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="task in arrayMarcaciones"
                v-if="
                  task.fechaHoraSalida === track.fecha &&
                  task.fechaHoraEntrada === track.fecha &&
                  task.fechaHoraAlmuerzoInicio === track.fecha &&
                  task.fechaHoraAlmuerzoFin === track.fecha
                "
                :key="task.Empleado"
              >
                <td v-text="task.Empleado"></td>
                <td v-text="task.Entrada"></td>
                <td v-text="task.AInicio"></td>
                <td v-text="task.AFin"></td>
                <td v-text="task.Salida"></td>
                <td v-text="task.Cumplimiento"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {     
      arrayEmpleados: [], 
      arrayMarcaciones: [], 
      arrayFechas: [], 
      selected_Empleado: "",
      selected_tipoMarcacion: "",
      selectedDate: "",
      selected_fechaHora: "",
      minDatetime: "2021-04-19T08:00:00",
      selected_fechaTabla: "",
    };
  },
  created() {
    axios
      .get("/marcacion/obtenerFechas")
      .then((res) => {
        this.arrayFechas = res.data;
        console.log(res.data);
      })
      .catch((err) => {
        console.log(err);
      });
    axios
      .get("/empleado/obtenerDropdown")
      .then((res) => {
        this.arrayEmpleados = res.data;
        console.log(res.data);
      })
      .catch((err) => {
        console.log(err);
      });
  },
  methods: {
    getFechas() {
      axios
        .get("/marcacion/obtenerFechas")
        .then((res) => {
          this.arrayFechas = res.data;
          console.log(res.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getMarcaciones() {
      let me = this;
      let url = "/marcacion"; 
      axios
        .get(url)
        .then(function (response) {
          me.arrayMarcaciones = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    agregarMarcacion() {
      let me = this;
      let url = "/marcacion/guardar"; 
      axios
        .post(url, {
          codigoEmpleado: this.selected_Empleado,
          tipoMarcacion: this.selected_tipoMarcacion,
          fechaHora: this.selected_fechaHora,
        })
        .then(function (response) {
          me.$swal({
            position: "top-end",
            icon: "success",
            title: "Se ha agregado la marcación",
            showConfirmButton: false,
            timer: 3000,
          });
          me.getFechas();
          me.getMarcaciones(); 
        })
        .catch(function (error) {
          let body = error.response.data.error;
          // me.$swal(body);
          me.$swal({
            position: "top-end",
            icon: "error",
            title: body,
            showConfirmButton: false,
            timer: 5000,
          });
          console.log(error);
        });
    },
  },
  mounted() {
    this.getMarcaciones();
    this.getFechas();
  },
};
</script>
