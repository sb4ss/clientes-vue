<script setup>
import { ref, computed } from "vue";
import Table from "./components/Table.vue";

const usersList = [
  {
    userID: "1",
    userName: "Juan Pérez",
    userEmail: "juan@example.com",
    userPhone: "+57 300 123 4567",
    createAT: "2025-03-08",
  },
  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },

  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
  {
    userID: "345",
    userName: "Ana López",
    userEmail: "ana@example.com",
    userPhone: "+57 301 234 5678",
    createAT: "2025-03-08",
  },
];

const userIDInput = ref("");

const filteredUsers = computed(() => {
  if (!userIDInput.value) return usersList;
  return usersList.filter((user) => user.userID === userIDInput.value);
});
</script>

<template>
  <div class="user-table">
    <input
      v-model="userIDInput"
      type="text"
      placeholder="Buscar por ID de usuario"
    />
    <button class="addUser"></button>
    <Table :users="filteredUsers" />
  </div>
</template>
<style scoped>
.user-table {
  position: relative;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: start;
  flex-direction: column;
  background-color: rgb(19, 19, 19);
  padding: 2rem;
  min-height: 30px;
}
input {
  outline: none;
  height: 40px;
  color: white;
  background-color: rgba(61, 61, 61, 0.137);
  width: 800px;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 8px;
  border: 1px solid #2b2b2b13;
}

header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }

  nav {
    text-align: left;
    margin-left: -1rem;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }
}
</style>
