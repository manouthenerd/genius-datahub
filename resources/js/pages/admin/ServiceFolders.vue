<template>
    <FoldersTable :folders :service />
</template>

<script setup lang="ts">
import FoldersTable from '@/components/explorer/FoldersTable.vue';
import ResourcesLayout from '@/layouts/dashboard/ResourcesLayout.vue';

interface Folder {
    id: number;
    name: string;
    size: number;
    updated_at: string;
}

interface Service {
    id: number;
    name: string;
}

defineProps<{ folders: Folder[]; service: Service }>();

defineOptions({ layout: ResourcesLayout });
</script>
