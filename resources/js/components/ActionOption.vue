<template>
    <Popover class="mr-2 w-[100px]">
        <PopoverTrigger>
            <Button variant="link" class="cursor-pointer">
                <Ellipsis />
            </Button>
        </PopoverTrigger>
        <PopoverContent>
            <div class="grid">
                <p class="text-xs text-zinc-400 text-left">Actions</p>
                <Separator />
                <Button variant="ghost" class="text-[#0074B8]">
                    Modifier
                    <Pen />
                </Button>
                <Button class="text-red-500" variant="outline" color="red">
                    Supprimer
                    <Trash />
                </Button>
            </div>
        </PopoverContent>
    </Popover>
</template>

<script setup lang="ts">
import { Ellipsis, Pen, Trash } from 'lucide-vue-next';
import { Popover, PopoverTrigger, PopoverContent } from '@/components/ui/popover';
import Separator from '@/components/ui/separator/Separator.vue';
import { Button } from '@/components/ui/button';

</script>