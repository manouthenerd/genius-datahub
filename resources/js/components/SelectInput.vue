<template>
    <Select>
        <SelectTrigger class="w-full">
            <SelectValue :placeholder/>
        </SelectTrigger>
        <SelectContent>
            <slot/>
        </SelectContent>
    </Select>

</template>

<script setup lang="ts">
import {
    Select,
    SelectContent,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";


defineProps({
    placeholder: String,
})
</script>