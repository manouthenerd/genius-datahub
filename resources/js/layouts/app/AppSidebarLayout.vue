<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import { Button } from '@/components/ui/button';
import { Sheet, SheetContent, SheetDescription, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
import type { BreadcrumbItemType } from '@/types';
import { Bell } from 'lucide-vue-next';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar />
        <AppContent variant="sidebar" class="overflow-x-hidden">
            <div class="flex items-center justify-between">
                <AppSidebarHeader :breadcrumbs="breadcrumbs" />
                <Sheet>
                    <SheetTrigger>
                        <Button class="mr-4">
                            <Bell />
                        </Button>
                    </SheetTrigger>
                    <SheetContent>
                        <SheetHeader class="mt-6">
                            <div class="bg-neutral-200 p-2 rounded-sm flex justify-between items-center">
                                <span class="font-bold">Notifications</span>
                                <!-- <span>
                                    <img src="/image/double-check.svg" alt="mark as read icon">
                                </span> -->
                                <span class="font-thin underline cursor-pointer text-xs">Marquer tout comme lu</span>
                            </div>
                        </SheetHeader>
                        <div class="p-2 mx-4 border border-slate-300 rounded h-full space-y-2 divide-y-2 overflow-y-scroll">
                            <div v-for="i in 8" :key="i" class="rounded p-3 hover:cursor-pointer transition-all hover:bg-[aliceblue]">
                                <div>
                                    <div>
                                        <div class="flex items-center gap-1">
                                            <span class="h-[8px] bg-blue-900 block w-[8px] rounded-full"></span>
                                            <p class="flex gap-1 items-center">
                                                <span
                                                    class="h-[18px] w-[18px] block bg-gradient-to-bl from-blue-300 to-green-400 via-orange-400 rounded-full"></span>
                                                <span class="font-bold">Nouvelle tâche ajoutée</span>

                                            </p>
                                        </div>
                                        <p class="text-xs font-thin">
                                            12/05/2025 13:40
                                        </p>
                                    </div>
                                    <div class="my-2 text-sm">
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </SheetContent>
                </Sheet>
            </div>
            <slot />
        </AppContent>
    </AppShell>
</template>
