<template>
    <FoldersTable :folders :service />

</template>

<script setup lang="ts">
import ResourcesLayout from '@/layouts/dashboard/ResourcesLayout.vue';
import FoldersTable from '@/components/explorer/FoldersTable.vue';

interface Folder {
    id: number,
    name: string,
    size: number,
    updated_at: string
}

interface Service {
    id: number,
    name: string
}

defineProps<{ folders: Folder[], service: Service }>();

defineOptions({ layout: ResourcesLayout })
</script>