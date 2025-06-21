import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

// Scene
const scene = new THREE.Scene();

// Get container and its size
const container = document.getElementById('logo3d');
const width = container.clientWidth;
const height = container.clientHeight;

// Camera
const camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
camera.position.set(2, 2, 3);

// Renderer
const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
renderer.setSize(width, height);
renderer.setPixelRatio(window.devicePixelRatio);
container.appendChild(renderer.domElement);

// Controls
const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.autoRotate = true;
controls.autoRotateSpeed = 1.2;
controls.enablePan = false;
controls.enableZoom = false;
controls.minPolarAngle = Math.PI / 4;
controls.maxPolarAngle = Math.PI * 3 / 4;

// Lighting
const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
scene.add(ambientLight);

const directionalLight = new THREE.DirectionalLight(0xffffff, 1.2);
directionalLight.position.set(5, 10, 7.5);
scene.add(directionalLight);

// Logo Group
const logoGroup = new THREE.Group();
scene.add(logoGroup);

// Materials - Laravel color palette
const materials = [
    new THREE.MeshStandardMaterial({ color: 0x718096, roughness: 0.4, metalness: 0.1 }),
    new THREE.MeshStandardMaterial({ color: 0x4A5568, roughness: 0.4, metalness: 0.1 }),
    new THREE.MeshStandardMaterial({ color: 0xFF2D20, roughness: 0.4, metalness: 0.1 }),
];

// Geometry - Boxes representing a bar chart
const boxSize = 1.2;
const boxHeights = [1.5, 2.5, 3.5];
const spacing = 0.25;

boxHeights.forEach((height, i) => {
    const geometry = new THREE.BoxGeometry(boxSize, height, boxSize);
    const box = new THREE.Mesh(geometry, materials[i % materials.length]);

    const xPos = (i - (boxHeights.length - 1) / 2) * (boxSize + spacing);
    box.position.set(xPos, height / 2, 0);

    logoGroup.add(box);
});

logoGroup.position.y = -1.5;

// Animation loop
function animate() {
    requestAnimationFrame(animate);
    controls.update();
    renderer.render(scene, camera);
}

// Resize handler
window.addEventListener('resize', onWindowResize, false);

function onWindowResize() {
    const newWidth = container.clientWidth;
    const newHeight = container.clientHeight;

    camera.aspect = newWidth / newHeight;
    camera.updateProjectionMatrix();

    renderer.setSize(newWidth, newHeight);
}

// Start animation
animate();
