<template>
  <div class="text-center">
    <h1>Упс... Похоже что-то пошло не так...</h1>

    <h2>{{ text ?? "Страница не найдена" }}</h2>
  </div>
</template>

<script>
export default {
  props: ["text"],
};
</script>