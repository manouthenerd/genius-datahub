<script setup lang="ts">
import { type HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <div>
        <img class="max-w-[200px]" src="image/logo-genius.png" alt="Logo de l'entreprise" />
    </div>
</template>
