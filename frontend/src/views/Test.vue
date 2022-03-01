<template>
  <div>
    <p>
      {{ id }}
    </p>

    <p>
      {{ text }}
    </p>
  </div>
</template>

<script>
export default {
  props: ["id", "text"],
};
</script>