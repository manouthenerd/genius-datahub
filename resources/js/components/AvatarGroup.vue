<template>
    <div class="flex">
        <Avatar>
            <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
            <AvatarFallback>CN</AvatarFallback>
        </Avatar>
        <Avatar class=" relative left-[-12px]">
            <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
            <AvatarFallback>CN</AvatarFallback>
        </Avatar>
        <Avatar class=" relative left-[-24px]">
            <AvatarImage src="https://github.com/unovue.png" alt="@unovue" />
            <AvatarFallback>CN</AvatarFallback>
        </Avatar>
        <Avatar class=" relative left-[-36px]">
            <AvatarImage src="" alt="@unovue" />
            <AvatarFallback>+5</AvatarFallback>
        </Avatar>
    </div>
</template>

<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

</script>