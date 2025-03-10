<script setup>
import { ref, onMounted, defineEmits, computed } from "vue";
import EditUser from "./EditUserModal.vue";
import NewUserModal from "./NewUserModal.vue";

const props = defineProps({});
const showModal = ref(false); // Controla la visibilidad del modal

// Variables reactivas
const usersList = ref(); // Almacena la lista de usuarios
const userIDInput = ref(""); // Almacena el ID del usuario a buscar

// GET para obtener los usuarios
const getUsers = async () => {
  try {
    const response = await fetch("http://localhost/backend/API/api.php/users", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    console.log(data);
    usersList.value = data;
  } catch (error) {
    console.error("Error al obtener los usuarios:", error);
  }
};

// Buscar usuarios por ID
const filteredUsers = computed(() => {
  if (!userIDInput.value) return usersList.value;
  return usersList.value.filter((user) => user.id == userIDInput.value);
});

onMounted(() => {
  getUsers();
});

// Controlar la visibilidad del modal
const toggleModal = () => {
  showModal.value = !showModal.value;
};

const EditUserModal = ref(false);
const selectedUser = ref(null);
const refreshKey = ref(true);
const emit = defineEmits("close-modal");
// Función para editar un usuario
const editUser = (user) => {
  selectedUser.value = { ...user };
  EditUserModal.value = true;
};

// Función para eliminar un usuario
const deleteUser = (user) => {
  selectedUser.value = { ...user };
  const id = selectedUser.value.id;
  const userID = { id: id };
  fetch(`http://localhost/backend/API/api.php/user/delete`, {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(userID),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      window.location.reload();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
};

// Función para cerrar el modal de edición
const closeEditModal = () => {
  EditUserModal.value = false;
  selectedUser.value = null;
};

// Función que maneja la actualizacion del componente
const handleUserUpdate = () => {
  window.location.reload();
};
</script>

<template>
  <input
    v-model="userIDInput"
    type="text"
    placeholder="Buscar por ID de usuario"
  />
  <div class="table-container">
    <table v-if="refreshKey">
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
        <tr v-for="user in filteredUsers" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.phone }}</td>
          <td>{{ user.created_at }}</td>
          <td>
            <button class="edit" @click="editUser(user)">✏️</button>
            <button class="delete" @click="deleteUser(user)">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  // Modal para editar usuario
  <EditUser
    v-if="EditUserModal"
    :user="selectedUser"
    @close="closeEditModal"
    @update-user="handleUserUpdate"
  />

  // Modal para agregar usuario
  <NewUserModal v-if="showModal" @close-modal="toggleModal" />
  <button class="addUser" @click="toggleModal">Nuevo</button>
</template>

<style scoped>
input {
  outline: none;
  height: 40px;
  color: white;
  background-color: rgba(61, 61, 61, 0.137);
  width: 700px;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 8px;
  border: 1px solid #2b2b2b13;
}
.addUser {
  right: 60px;
  position: absolute;
  background-color: transparent;
  color: white;
  padding: 10px;
  border-radius: 8px;
  border: 2px solid rgba(71, 71, 71, 0.397);
  cursor: pointer;
}

.addUser:hover {
  background-color: rgba(71, 71, 71, 0.397);
}
.id {
  min-width: 50px;
}
.table-container {
  display: flex;
  justify-content: center;
  padding: 20px;
}

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

th,
td {
  padding: 12px 16px;
  text-align: left;
  border-bottom: 2px solid #e0e0e00a;
}

th {
  background: #222222;
  color: white;
  text-transform: uppercase;
}

tbody tr:hover {
  transition: 0.5s;
  background: #1b1b1b;
}

button {
  border: none;
  padding: 6px 10px;
  margin: 2px;
  border-radius: 4px;
  cursor: pointer;
}

button.edit {
  background: #ffda6a;
  color: #fff;
}

button.delete {
  background: #5e5e5e;
  color: #fff;
}

button.delete:hover {
  transition: 0.2s;
  background: #ff6b6b;
}

button:hover {
  opacity: 0.8;
}
</style>
