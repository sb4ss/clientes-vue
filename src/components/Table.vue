<script setup>
defineProps({
  users: Array,
});
</script>

<template>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th class="id">ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Teléfono</th>
          <th>Fecha de creación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.userID">
          <td>{{ user.userID }}</td>
          <td>{{ user.userName }}</td>
          <td>{{ user.userEmail }}</td>
          <td>{{ user.userPhone }}</td>
          <td>{{ user.createAT }}</td>
          <td>
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<style scoped>
.id {
  min-width: 50px;
}
.table-container {
  display: flex;
  justify-content: center;
  padding: 20px;
}

/* Estilos generales de la tabla */
table {
  min-width: 900px;
  max-width: 900px;
  border-collapse: collapse;
  background: #292929;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
  color: rgb(219, 219, 219);
}

/* Estilos de las celdas */
th,
td {
  padding: 12px 16px;
  text-align: left;
  border-bottom: 2px solid #e0e0e00a;
}

/* Estilos para los encabezados */
th {
  background: #222222;
  color: white;
  text-transform: uppercase;
}

/* Estilos para las filas */
tbody tr:hover {
  transition: 0.5s;
  background: #1b1b1b;
}

/* Botones */
button {
  border: none;
  padding: 6px 10px;
  margin: 2px;
  border-radius: 4px;
  cursor: pointer;
}

/* Estilos para los botones de edición y eliminación */
button.edit {
  background: #ffc107;
  color: #fff;
}

button.delete {
  background: #dc3545;
  color: #fff;
}

button:hover {
  opacity: 0.8;
}
</style>
