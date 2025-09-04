<template>
    <div class="flex">
        <Avatar v-for="count in counts" class="relative" :class="`left-[-${(count + 1) * 12}px]`" :key="count">
            <AvatarImage src="https://avatar.iran.liara.run/public" alt="@unovue" />
            <AvatarFallback>ɤ</AvatarFallback>
        </Avatar>
    </div>
</template>

<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

defineProps({
    counts: Number,
});
</script>
